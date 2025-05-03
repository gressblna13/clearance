<!-- clearance_history.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Clearance</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(to right, #eef2f3, #8e9eab);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Clearance SPBE</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clearance.index') }}">Isi Formulir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
    <h2 class="text-center mb-4">Riwayat Clearance</h2>

    <!-- Table to display the records -->
    <div class="card shadow-lg p-5 mx-auto">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Instansi</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Nama Kegiatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clearances as $clearance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $clearance->instansi }}</td>
                    <td>{{ $clearance->nomor_surat }}</td>
                    <td>{{ $clearance->tanggal_surat }}</td>
                    <td>{{ $clearance->nama_kegiatan }}</td>
                    <td>
                        <a href="{{ route('clearance.download', $clearance->id) }}" class="btn btn-primary btn-sm">Download</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; {{ date('Y') }} Clearance SPBE. All Rights Reserved.
</footer>

</body>
</html>
