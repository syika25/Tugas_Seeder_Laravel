@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1>Detail Mahasiswa</h1>

        <div class="card">
           <div class="card-header">
            <strong>Detail Mahasiswa</strong> 
           </div>
            <div class="card-body">
                <p><strong>NPM:</strong> {{ $detailMahasiswa->npm }}</p>
                <p><strong>Nama:</strong> {{ $detailMahasiswa->nama }}</p>
                <p><strong>Dosen Wali:</strong> {{ $detailMahasiswa->dosen?->nama ?? '-' }}</p>
            </div>
        </div>
    </div> 
@endsection