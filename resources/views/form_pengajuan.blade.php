<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layanan Akademik FUSPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --fuspi:#4169E1; --fuspi-dark:#294bb7; --gold:#FDBE00; --ink:#172033; }
        html, body {
            width:100%;
            height:100%;
            margin:0;
            overflow:hidden;
        }
        body {
            background:#f5f7fb;
            color:var(--ink);
            font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
        }
        [hidden] { display:none !important; }
        .screen {
            position:fixed;
            inset:0;
            width:100%;
            height:100dvh;
        }
        .hero {
            /* Layar pembuka benar-benar terpisah dari form. */
            z-index:10;
            height:100dvh;
            background-color:#4776c5;
            background-image:url("{{ asset('images/background-layanan-akademik.jpg') }}");
            background-size:contain;
            background-position:center top;
            background-repeat:no-repeat;
            display:flex;
            align-items:flex-end;
            justify-content:center;
            padding:32px 18px 38px;
        }
        .hero-actions { width:min(920px,100%); display:flex; justify-content:center; gap:14px; flex-wrap:wrap; }
        .hero-btn { min-width:250px; padding:14px 24px; border-radius:14px; font-weight:800; text-decoration:none; text-align:center; box-shadow:0 10px 28px rgba(0,0,0,.18); transition:.2s ease; }
        .hero-btn:hover { transform:translateY(-2px); }
        .hero-btn-primary { background:var(--gold); color:#18254a; border:2px solid #fff; }
        .hero-btn-secondary { background:rgba(255,255,255,.95); color:var(--fuspi-dark); border:2px solid var(--fuspi); }
        .form-section {
            z-index:20;
            display:none;
            overflow-y:auto;
            padding:58px 16px;
            background:linear-gradient(180deg,#eef3ff 0%,#f8faff 100%);
        }
        body.form-open .hero { display:none; }
        body.form-open .form-section { display:block; }
        .form-card { max-width:900px; margin:auto; background:#fff; border:1px solid rgba(65,105,225,.15); border-radius:22px; overflow:hidden; box-shadow:0 20px 55px rgba(37,58,120,.13); }
        .form-header { background:linear-gradient(135deg,var(--fuspi),#5c7ee8); color:#fff; padding:26px 30px; border-bottom:4px solid var(--gold); }
        .form-header h1 { margin:0 0 5px; font-size:1.45rem; font-weight:800; }
        .form-header p { margin:0; opacity:.9; }
        .form-body { padding:30px; }
        .form-body h2 { color:var(--fuspi-dark); font-weight:800; border-left:4px solid var(--gold); padding-left:10px; }
        .form-control,.form-select { border-radius:10px; padding:10px 12px; border-color:#ccd5e5; }
        .form-control:focus,.form-select:focus { border-color:var(--fuspi); box-shadow:0 0 0 .2rem rgba(65,105,225,.13); }
        .submit-btn { background:var(--fuspi); border:0; border-radius:12px; padding:13px; font-weight:800; }
        .submit-btn:hover { background:var(--fuspi-dark); }
        .top-actions { display:flex; gap:10px; flex-wrap:wrap; margin-top:16px; }
        .top-actions a { border-radius:10px; font-weight:700; }
        @media(max-width:768px){
            .hero {
                height:100dvh;
                background-size:contain;
                background-position:center top;
                padding:20px 14px 24px;
            }
            .hero-actions {
                background:rgba(24,37,74,.52);
                backdrop-filter:blur(5px);
                -webkit-backdrop-filter:blur(5px);
                border:1px solid rgba(255,255,255,.22);
                border-radius:18px;
                padding:12px;
            }
            .hero-btn { width:100%; min-width:0; }
            .form-body { padding:22px 16px; }
        }
    </style>
</head>
<body>
<section id="intro-screen" class="hero screen" aria-label="Layanan Akademik FUSPI">
    <div class="hero-actions">
        <button type="button" id="btn-buka-form" class="hero-btn hero-btn-primary border-0">Isi Surat Permohonan</button>
        <a href="{{ route('pemohon.index') }}" class="hero-btn hero-btn-secondary">Cek Status Permohonan</a>
    </div>
</section>

<section id="form-pengajuan" class="form-section screen" aria-hidden="true">
    <div class="form-card">
        <header class="form-header">
            <h1>Form Pengajuan Surat Mahasiswa</h1>
            <p>Pilih jenis surat yang dibutuhkan, lengkapi data, dan unggah dokumen pendukung.</p>
            <nav class="top-actions" aria-label="Akses layanan">
                <a class="btn btn-light" href="{{ route('pemohon.index') }}">Cek Permohonan</a>
                <a class="btn btn-outline-light" href="{{ route('login') }}">Dashboard Admin</a>
            </nav>
        </header>
        <div class="form-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert"><strong>Periksa kembali isian Anda:</strong><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="h5">Data Mahasiswa</h2>
                <div class="row g-3 mb-4">
                    <div class="col-md-6"><label class="form-label" for="nama_mahasiswa">Nama mahasiswa *</label><input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" maxlength="100" required></div>
                    <div class="col-md-6"><label class="form-label" for="nim">NIM *</label><input class="form-control" id="nim" name="nim" value="{{ old('nim') }}" maxlength="30" required></div>
                    <div class="col-md-6"><label class="form-label" for="email">Email mahasiswa *</label><input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required></div>
                    <div class="col-md-6"><label class="form-label" for="prodi">Program studi *</label><select class="form-select" id="prodi" name="prodi" required><option value="">-- Pilih Prodi --</option>@foreach (["Ilmu Al-Qur'an dan Tafsir", 'Ilmu Hadis', 'Aqidah dan Filsafat Islam'] as $prodi)<option value="{{ $prodi }}" @selected(old('prodi') === $prodi)>{{ $prodi }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label class="form-label" for="semester">Semester *</label><input class="form-control" id="semester" name="semester" value="{{ old('semester') }}" maxlength="30" required></div>
                    <div class="col-md-6"><label class="form-label" for="tempat_lahir">Tempat lahir *</label><input class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" maxlength="100" required></div>
                    <div class="col-md-6"><label class="form-label" for="tanggal_lahir">Tanggal lahir *</label><input class="form-control" type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" required></div>
                </div>
                <h2 class="h5">Jenis Layanan</h2>
                <select class="form-select mb-4" id="jenis_layanan" name="jenis_layanan" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach (['aktif_kuliah_umum' => 'Aktif Kuliah (Umum)', 'aktif_kuliah_tunjangan_ortu' => 'Aktif Kuliah (Tunjangan Orang Tua)', 'magang' => 'Magang', 'observasi' => 'Observasi', 'penelitian' => 'Penelitian', 'rekomendasi' => 'Rekomendasi'] as $kode => $label)
                        <option value="{{ $kode }}" @selected(old('jenis_layanan') === $kode)>{{ $label }}</option>
                    @endforeach
                </select>
                <div id="bidang_layanan" hidden>
                    <div data-field="tujuan_surat" class="mb-3" hidden><label class="form-label" for="tujuan_surat">Kepada *</label><input class="form-control" id="tujuan_surat" name="tujuan_surat" value="{{ old('tujuan_surat') }}" maxlength="255"></div>
                    <div data-field="keperluan" class="mb-3" hidden><label class="form-label" for="keperluan">Keperluan *</label><textarea class="form-control" id="keperluan" name="keperluan" rows="3">{{ old('keperluan') }}</textarea></div>
                    <div data-field="dosen_pembimbing" class="mb-3" hidden><label class="form-label" for="dosen_pembimbing">Dosen pembimbing *</label><input class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" value="{{ old('dosen_pembimbing') }}" maxlength="255"></div>
                    <div data-field="mata_kuliah" class="mb-3" hidden><label class="form-label" for="mata_kuliah">Mata kuliah *</label><input class="form-control" id="mata_kuliah" name="mata_kuliah" value="{{ old('mata_kuliah') }}" maxlength="255"></div>
                    <div data-field="judul_skripsi" class="mb-3" hidden><label class="form-label" for="judul_skripsi">Judul skripsi *</label><input class="form-control" id="judul_skripsi" name="judul_skripsi" value="{{ old('judul_skripsi') }}" maxlength="255"></div>
                    <div data-field="tempat_penelitian" class="mb-3" hidden><label class="form-label" for="tempat_penelitian">Tempat penelitian *</label><input class="form-control" id="tempat_penelitian" name="tempat_penelitian" value="{{ old('tempat_penelitian') }}" maxlength="255"></div>
                    <h2 class="h5 mt-4">Upload Dokumen</h2>
                    <div class="mb-3"><label class="form-label" for="file_ukt">Bukti pembayaran UKT *</label><input class="form-control" type="file" id="file_ukt" name="file_ukt" accept=".pdf,.jpg,.jpeg,.png" required><small class="text-muted">PDF/JPG/PNG maksimal 2 MB</small></div>
                    <div id="field_sk_ortu" class="mb-3" hidden><label class="form-label" for="file_sk_ortu">SK terakhir orang tua *</label><input class="form-control" type="file" id="file_sk_ortu" name="file_sk_ortu" accept=".pdf"><small class="text-muted">PDF maksimal 2 MB</small></div>
                    <button class="btn btn-primary w-100 submit-btn" type="submit">Kirim Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
(() => {

    const btnBukaForm = document.getElementById('btn-buka-form');
    const formSection = document.getElementById('form-pengajuan');

    if (btnBukaForm && formSection) {
        btnBukaForm.addEventListener('click', () => {
            document.body.classList.add('form-open');
            formSection.setAttribute('aria-hidden', 'false');
            formSection.scrollTop = 0;
        });
    }

    const select = document.getElementById('jenis_layanan');
    const fields = document.getElementById('bidang_layanan');
    const sk = document.getElementById('field_sk_ortu');
    const mapping = {
        aktif_kuliah_umum: ['keperluan'],
        aktif_kuliah_tunjangan_ortu: ['keperluan'],
        magang: ['tujuan_surat', 'keperluan', 'dosen_pembimbing'],
        observasi: ['tujuan_surat', 'keperluan', 'dosen_pembimbing', 'mata_kuliah'],
        penelitian: ['tujuan_surat', 'judul_skripsi', 'tempat_penelitian'],
        rekomendasi: ['tujuan_surat', 'keperluan']
    };
    function update() {
        const code = select.value;
        fields.hidden = !Object.prototype.hasOwnProperty.call(mapping, code);
        fields.querySelectorAll('[data-field]').forEach(wrapper => {
            const active = (mapping[code] || []).includes(wrapper.dataset.field);
            wrapper.hidden = !active;
            const input = wrapper.querySelector('input, textarea');
            input.disabled = !active;
            input.required = active;
        });
        sk.hidden = code !== 'aktif_kuliah_tunjangan_ortu';
        sk.querySelector('input').disabled = sk.hidden;
        sk.querySelector('input').required = !sk.hidden;
        document.getElementById('file_ukt').disabled = fields.hidden;
    }
    select.addEventListener('change', update);
    update();

    @if($errors->any())
        document.body.classList.add('form-open');
        formSection?.setAttribute('aria-hidden', 'false');
        if (formSection) formSection.scrollTop = 0;
    @endif
})();
</script>
</body>
</html>
