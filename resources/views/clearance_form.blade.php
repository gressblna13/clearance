<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Clearance SPBE</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(to right, #eef2f3, #8e9eab);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Clearance SPBE</a>
    <div>
        <a href="{{ route('clearance.history') }}" class="btn btn-outline-light btn-sm">Riwayat Clearance</a>
    </div>
  </div>
</nav>

<!-- Main Form -->
<div class="container content py-5">
    <h2 class="text-center mb-4">Formulir Pengisian Clearance</h2>

    <div class="card shadow-lg p-5 mx-auto" style="max-width: 900px;">
        <form action="{{ route('clearance.store') }}" method="POST" id="clearanceForm">
            @csrf

            <div class="row">
                <!-- Informasi Dasar -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jabatan Instansi</label>
                    <input type="text" name="jabatan_instansi" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Instansi</label>
                    <input type="text" name="instansi" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal (Nota Dinas)</label>
                    <input type="text" name="tanggal" placeholder="Contoh: Maret 2025" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tahun Anggaran</label>
                    <input type="text" name="tahun_anggaran" class="form-control" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Perihal</label>
                    <input type="text" name="perihal" class="form-control" required>
                </div>

                <!-- Data Belanja -->
<div class="col-12">
    <h5 class="text-primary mt-4">Data Belanja</h5>
</div>

<div class="col-md-6 mb-3">
    <label class="form-label">Nama Kegiatan</label>
    <input type="text" name="nama_kegiatan" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
    <label class="form-label">Belanja Infrastruktur</label>
    <input type="text" name="belanja_infrastruktur" class="form-control" required>
</div>

<div id="item-container">
    <!-- Baris Item Belanja Pertama -->
    <div class="row mb-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Item Belanja</label>
            <input type="text" name="item_belanja[]" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Total Anggaran (Rp)</label>
            <input type="text" name="total_anggaran[]" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Usulan Rekomendasi</label>
            <select name="usulan_rekomendasi[]" class="form-select" required>
                <option value="Dilanjutkan">Dilanjutkan</option>
                <option value="Tidak Dilanjutkan">Tidak Dilanjutkan</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">-</button>
        </div>
    </div>
</div>

<div class="text-center mb-4">
    <button type="button" class="btn btn-outline-primary" onclick="addItem()">+ Tambah Item Belanja</button>
</div>

<script>
    function addItem() {
        const container = document.getElementById('item-container');
        const html = `
            <div class="row mb-3 align-items-end">
                <div class="col-md-4">
                    <input type="text" name="item_belanja[]" class="form-control" placeholder="Item Belanja" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="total_anggaran[]" class="form-control" placeholder="Total Anggaran (Rp)" required>
                </div>
                <div class="col-md-3">
                    <select name="usulan_rekomendasi[]" class="form-select" required>
                        <option value="Dilanjutkan">Dilanjutkan</option>
                        <option value="Tidak Dilanjutkan">Tidak Dilanjutkan</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">-</button>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
    }

    function removeItem(button) {
        button.closest('.row').remove();
    }
</script>
                <!-- Tambahan -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kata "melanjutkan / tidak melanjutkan"</label>
                    <select name="kata_melanjutkan" class="form-select" required>
                        <option value="melanjutkan">Melanjutkan</option>
                        <option value="tidak melanjutkan">Tidak Melanjutkan</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="col-12 text-center">
                    <button type="submit" id="submitBtn" class="btn btn-primary w-50">
                        <span id="btnText">Submit Formulir</span>
                        <div id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"></div>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; {{ date('Y') }} Clearance SPBE. All Rights Reserved.
</footer>

<!-- JS -->
<script>


@if(session('success'))
    Swal.fire({
        title: 'Sukses!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
@endif
</script>

</body>
</html>
