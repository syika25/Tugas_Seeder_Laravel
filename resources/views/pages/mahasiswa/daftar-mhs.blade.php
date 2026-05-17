@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>Halaman Mahasiswa</h1>
    </div>
    <div class="card">
        <div class="alert alert-primary" role="alert">
            Halaman ini menampilkan daftar mahasiswa
            @if (session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="card p-3">
            <!-- 🔍 Header: Tombol Tambah + Form Search -->
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah Data</a>

                <form class="d-flex align-items-center" method="GET" action="{{ route('mahasiswa') }}">
                    <select class="form-select me-2" style="width: 80px;" name="perPage" onchange="this.form.submit()">
                        <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                    </select>
                    <div class="input-group mb-0">
                        <input name="keyword" type="text" class="form-control" placeholder="Cari data..." value="{{ request('keyword') }}">
                        <button class="input-group-text" type="submit" id="basic-addon2">Cari data</button>
                    </div>
                </form>
            </div>

            <!-- 📊 Tabel Data -->
            <table class="table table-hover table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">NO</th>
                        <th scope="col">NPM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Dosen</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataMahasiswa as $index => $mhs)
                    <tr>
                        <!-- ✅ Nomor urut tetap benar meski di halaman berapa pun -->
                        <td scope="row" class="text-center">{{ $dataMahasiswa->firstItem() + $index }}</td>
                        <td>{{ $mhs->npm }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->dosen?->nama ?? '-' }}</td>
                        
                        <td>
                            <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('mahasiswa.show', $mhs->npm) }}" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada data mahasiswa yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- 🔗 Pagination -->
            <div class="mt-3">
                {{ $dataMahasiswa->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection