<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex justify-content-around align-items-center mb-4">
      <h1>Data Mahasiswa</h1>
      <button class="btn btn-primary ms-3">Tambah Mahasiswa</button>
    </div>
    <table class="table table-striped" border="1">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">NPM</th>
          <th scope="col">Nama</th>
          <th scope="col">Dosen Pembimbing</th>
          <th scope="col">Matakuliah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($mahasiswa as $mhs)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $mhs->npm }}</td>
          <td>{{ $mhs->nama }}</td>
          <td>{{ $mhs->dosen->nama ?? 'Tidak ada dosen' }}</td>
          <td>
            @if ($mhs->krs->isEmpty())
              Tidak ada matakuliah
            @else
              <ul>
                @foreach ($mhs->krs as $krs)
                  <li>{{ $krs->mataKuliah->nama_matakuliah ?? 'Tidak ada matakuliah' }}</li>
                @endforeach
              </ul>
            @endif
        </tr>
        @endforeach 
      </tbody>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>