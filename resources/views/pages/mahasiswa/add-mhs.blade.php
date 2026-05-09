@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>{{ (isset($detailMahasiswa)) ? 'Form Edit Mahasiswa' : 'Form Tambah Mahasiswa' }}</h1>
        <div class="card">
           <div class="card-header">Form Mahasiswa</div>
            <div class="card-body">
                <form method="POST" 
                    action="{{ isset($detailMahasiswa) ? route('mahasiswa.update', $detailMahasiswa->npm) : route('mahasiswa.store') }}">
                    @csrf   
                    @if (isset($detailMahasiswa))
                        @method('PUT')
                    @endif

                <div class="mb-3">
                    <label for="npm" class="form-label">NPM</label>
                    <input type="text" class="form-control" name="npm" value="{{ old('npm', $detailMahasiswa->npm ?? '') }}">
                    @error('npm')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $detailMahasiswa->nama ?? '') }}">
                    @error('nama')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nidn" class="form-label">Dosen Wali</label>
                    <select name="nidn" class="form-select">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->nidn }}" 
                                {{ (old('nidn', $detailMahasiswa->nidn ?? '') == $dosen->nidn) ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('nidn')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div> 
@endsection