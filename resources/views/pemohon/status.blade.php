<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengecekan Permohonan Mahasiswa - FUSPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root{--fuspi:#4169E1;--fuspi-dark:#294bb7;--gold:#FDBE00;--ink:#172033;--muted:#687386}
        *{box-sizing:border-box}
        body{min-height:100vh;margin:0;background:linear-gradient(135deg,#eef3ff 0%,#f8faff 48%,#fff8e6 100%);color:var(--ink);font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif}
        .page-wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:42px 16px}
        .status-card{width:100%;max-width:1000px;background:rgba(255,255,255,.98);border:1px solid rgba(65,105,225,.14);border-radius:26px;overflow:hidden;box-shadow:0 22px 65px rgba(32,53,110,.14)}
        .hero{position:relative;text-align:center;padding:36px 28px 30px;background:linear-gradient(135deg,var(--fuspi),#5c7ee8);color:#fff}
        .hero:after{content:"";position:absolute;left:0;right:0;bottom:0;height:4px;background:var(--gold)}
        .hero-icon{width:68px;height:68px;margin:0 auto 17px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.28);font-size:31px;font-weight:700}
        .hero h1{margin:0;font-size:clamp(1.45rem,3vw,2.15rem);font-weight:800;letter-spacing:.055em;text-transform:uppercase}
        .hero p{margin:10px 0 0;color:rgba(255,255,255,.88);font-size:.96rem}
        .content{padding:34px}
        .registration{max-width:650px;margin:0 auto 28px;padding:20px 25px;text-align:center;background:#f7f9ff;border:2px dashed rgba(65,105,225,.55);border-radius:18px;position:relative}
        .registration .label{display:block;font-size:.76rem;font-weight:800;letter-spacing:.13em;color:var(--muted);text-transform:uppercase;margin-bottom:7px}
        .registration .number{font-size:clamp(1.3rem,3vw,2rem);font-weight:850;letter-spacing:.04em;color:var(--fuspi);word-break:break-word}
        .status-box{border-radius:17px;padding:18px 20px;margin:0 auto 26px;max-width:780px;text-align:center;border:1px solid transparent}
        .status-box.success{background:#ecf9f1;border-color:#bfe8cf;color:#17633a}
        .status-box.waiting{background:#edf4ff;border-color:#c8d9ff;color:#315083}
        .status-title{font-weight:800;text-transform:uppercase;letter-spacing:.035em;margin-bottom:5px}
        .preview-shell{margin-top:26px;border:1px solid #dfe5f2;border-radius:20px;background:#f7f9fc;padding:18px;box-shadow:inset 0 1px 0 #fff}
        .preview-heading{text-align:center;margin-bottom:16px}
        .preview-heading h2{font-size:1rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin:0;color:#29344c}
        .preview-heading p{font-size:.85rem;color:var(--muted);margin:6px 0 0}
        .pdf-frame{width:100%;height:620px;border:1px solid #d7deeb;border-radius:14px;background:#fff}
        .actions{display:flex;justify-content:center;align-items:center;gap:12px;flex-wrap:wrap;margin-top:28px}
        .action-btn{display:inline-flex;align-items:center;justify-content:center;min-width:205px;padding:13px 22px;border-radius:13px;text-decoration:none;font-weight:750;transition:.2s ease;border:1px solid transparent;box-shadow:0 8px 18px rgba(29,46,91,.09)}
        .btn-back{background:#fff;color:#44516a;border-color:#cfd6e3}.btn-back:hover{background:#f3f5f8;color:#202a3d;transform:translateY(-1px)}
        .btn-download{background:var(--fuspi);color:#fff}.btn-download:hover{background:var(--fuspi-dark);color:#fff;transform:translateY(-1px);box-shadow:0 10px 24px rgba(65,105,225,.24)}
        .waiting-panel{max-width:780px;margin:25px auto 0;padding:32px 22px;border-radius:18px;text-align:center;background:#fafbfe;border:1px solid #e1e6f0;color:var(--muted)}
        .waiting-panel strong{display:block;color:#37435a;margin-bottom:7px;text-transform:uppercase;letter-spacing:.04em}
        .footer-note{text-align:center;color:#8a94a6;font-size:.78rem;margin-top:24px}
        @media(max-width:768px){.page-wrap{padding:20px 10px}.content{padding:25px 16px}.hero{padding:30px 18px 26px}.pdf-frame{height:500px}.action-btn{width:100%}}
    </style>
</head>
<body>
<div class="page-wrap">
    <main class="status-card">
        <header class="hero">
            <div class="hero-icon">✓</div>
            <h1>Pengecekan Permohonan Mahasiswa</h1>
            <p>Layanan Administrasi Surat Fakultas Ushuluddin dan Pemikiran Islam</p>
        </header>

        <section class="content">
            <div class="registration">
                <span class="label">Nomor Pengajuan</span>
                <div class="number">{{ $pengajuan->nomor_pengajuan }}</div>
            </div>

            @if($siap)
                <div class="status-box success">
                    <div class="status-title">Surat Permohonan Telah Selesai</div>
                    <div>Surat Anda sudah disahkan. Silakan periksa pratinjau surat final di bawah ini sebelum mengunduh dokumen PDF.</div>
                </div>

                <div class="preview-shell">
                    <div class="preview-heading">
                        <h2>Pratinjau Surat Permohonan Final</h2>
                        <p>Dokumen berikut merupakan surat final yang siap diunduh.</p>
                    </div>

                    <iframe
                        class="pdf-frame"
                        src="{{ route('pemohon.preview') }}#toolbar=1&navpanes=0&view=FitH"
                        title="Pratinjau Surat Permohonan Final">
                    </iframe>
                </div>

                <div class="actions">
                    <a href="{{ route('pemohon.index') }}" class="action-btn btn-back">( ← Kembali )</a>
                    <a href="{{ route('pemohon.download') }}" class="action-btn btn-download">( ↓ Unduh Surat PDF )</a>
                </div>
            @else
                <div class="status-box waiting">
                    <div class="status-title">Permohonan Sedang Diproses</div>
                    <div>Permohonan Anda sedang dalam proses pemeriksaan dan penyelesaian oleh petugas.</div>
                </div>

                <div class="waiting-panel">
                    <strong>Surat Final Belum Tersedia</strong>
                    Pratinjau dan tombol unduh akan tersedia setelah admin memvalidasi berkas dan mengunggah surat yang telah disahkan. Silakan lakukan pengecekan kembali secara berkala.
                </div>

                <div class="actions">
                    <a href="{{ route('pemohon.index') }}" class="action-btn btn-back">( ← Cek Nomor Lain )</a>
                </div>
            @endif

            <div class="footer-note">FUSPI · UIN Sultan Maulana Hasanuddin Banten</div>
        </section>
    </main>
</div>
</body>
</html>
