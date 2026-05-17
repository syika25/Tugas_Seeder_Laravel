<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->keyword;
        $perPage = $request->perPage ?: 5; // Default 5 jika tidak ada input

        $dataMahasiswa = Mahasiswa::with('dosen')
            ->when($search, function($query, $search) {
                return $query->where('npm', 'like', "%$search%")
                            ->orWhere('nama', 'like', "%$search%")
                            ->orWhereHas('dosen', function($q) use ($search) {
                                $q->where('nama', 'like', "%$search%");
                            });
            })
            ->orderBy('npm', 'asc') // Urutkan berdasarkan NPM (karena primary key = npm)
            ->paginate($perPage)
            ->withQueryString(); // Preserve keyword & perPage di pagination

        return view('pages.mahasiswa.daftar-mhs', compact('dataMahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all(); // Ambil data dosen untuk dropdown
        return view('pages.mahasiswa.add-mhs', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm'  => 'required|unique:mahasiswa,npm',
            'nama' => 'required|min:3',
            'nidn' => 'required|exists:dosen,nidn',
        ],
        [
            'npm.required' => 'NPM wajib diisi',
            'npm.unique' => 'NPM sudah terdaftar',
            'nama.required' => 'Nama mahasiswa wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nidn.required' => 'Dosen wali wajib dipilih',
            'nidn.exists' => 'Dosen tidak ditemukan',
        ]);

        // Simpan data
        Mahasiswa::create($validated);
        
        return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $npm)
    {
        $detailMahasiswa = Mahasiswa::with('dosen')->findOrFail($npm);
        return view('pages.mahasiswa.detail-mhs', compact('detailMahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $npm)
    {
        $detailMahasiswa = Mahasiswa::findOrFail($npm);
        $dosens = Dosen::all();

        return view('pages.mahasiswa.add-mhs', compact('detailMahasiswa', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $npm)
    {
        $validated = $request->validate([
            'npm' => 'required|unique:mahasiswa,npm,'.$npm.',npm',
            'nama' => 'required|min:3',
            'nidn' => 'required|exists:dosen,nidn',
        ],
        [
            'npm.required' => 'NPM wajib diisi',
            'npm.unique' => 'NPM sudah terdaftar',
            'nama.required' => 'Nama mahasiswa wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nidn.required' => 'Dosen wali wajib dipilih',
            'nidn.exists' => 'Dosen tidak ditemukan',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($npm);
        $mahasiswa->update($validated);
        
        return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $npm)
    {
        Mahasiswa::destroy($npm);
        return redirect()->route('mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
