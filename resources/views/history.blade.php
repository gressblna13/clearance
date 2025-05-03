<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Clearance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="/">Clearance SPBE</a>
  </div>
</nav>

<div class="container">
    <h2 class="text-center mb-4">Riwayat Clearance</h2>

    <div class="card shadow p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Instansi</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Nomor Surat</th>
                        <th>Sifat Surat</th>
                        <th>Hal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clearances as $clearance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $clearance->instansi }}</td>
                        <td>{{ $clearance->nama_kegiatan }}</td>
                        <td>{{ $clearance->tanggal }}</td>
                        <td>{{ $clearance->nomor_surat }}</td>
                        <td>{{ $clearance->sifat_surat }}</td>
                        <td>{{ $clearance->hal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
