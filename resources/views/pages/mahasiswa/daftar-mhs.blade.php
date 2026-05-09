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
            <div class="mb-2">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>
            <table class="table table-hover table-bordered table-striped">
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
                    @foreach ($dataMahasiswa as $mhs)
                    <tr>
                        <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $mhs->npm }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->dosen?->nama ?? '-' }}</td>
                        
                        <td>
                            <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('mahasiswa.show', $mhs->npm) }}" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection