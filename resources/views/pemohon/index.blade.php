<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengecekan Permohonan Mahasiswa - FUSPI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --fuspi-blue: #4169E1;
            --fuspi-blue-dark: #3155c6;
            --fuspi-gold: #FDBE00;
            --text-dark: #1f2937;
            --muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(circle at top left, rgba(65, 105, 225, .14), transparent 34%),
                radial-gradient(circle at bottom right, rgba(253, 190, 0, .12), transparent 30%),
                #f5f7fb;
            color: var(--text-dark);
            font-family: Arial, Helvetica, sans-serif;
        }

        .page-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 16px;
        }

        .check-card {
            width: 100%;
            max-width: 760px;
            background: #fff;
            border: 1px solid rgba(65, 105, 225, .12);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 22px 60px rgba(31, 41, 55, .13);
        }

        .card-top {
            position: relative;
            padding: 34px 28px 30px;
            text-align: center;
            color: #fff;
            background: linear-gradient(135deg, var(--fuspi-blue), #3155c6);
        }

        .card-top::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translate(-50%, 50%);
            width: 66px;
            height: 5px;
            border-radius: 999px;
            background: var(--fuspi-gold);
        }

        .icon-box {
            width: 66px;
            height: 66px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, .55);
            border-radius: 18px;
            background: rgba(255, 255, 255, .13);
            font-size: 30px;
        }

        .card-top h1 {
            margin: 0;
            font-size: clamp(1.35rem, 3vw, 1.9rem);
            line-height: 1.35;
            font-weight: 800;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .card-top p {
            margin: 10px 0 0;
            color: rgba(255, 255, 255, .9);
            font-size: .96rem;
        }

        .card-content {
            padding: 40px 42px 42px;
        }

        .instruction {
            margin-bottom: 24px;
            padding: 16px 18px;
            border: 1px solid #dbe4ff;
            border-radius: 14px;
            background: #f7f9ff;
            color: #4b5563;
            text-align: center;
            line-height: 1.65;
        }

        .form-label {
            font-weight: 700;
            color: #374151;
            margin-bottom: 9px;
            text-transform: uppercase;
            font-size: .82rem;
            letter-spacing: .6px;
        }

        .form-control {
            min-height: 56px;
            border: 2px solid #e3e8f2;
            border-radius: 13px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: .2s ease;
        }

        .form-control:focus {
            border-color: var(--fuspi-blue);
            box-shadow: 0 0 0 .22rem rgba(65, 105, 225, .13);
        }

        .action-box {
            margin-top: 28px;
            padding-top: 25px;
            border-top: 1px solid #edf0f5;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 13px;
        }

        .btn-action {
            min-width: 210px;
            padding: 13px 22px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all .2s ease;
            box-shadow: 0 7px 18px rgba(31, 41, 55, .08);
        }

        .btn-check {
            border: 2px solid var(--fuspi-blue);
            background: var(--fuspi-blue);
            color: #fff;
        }

        .btn-check:hover {
            background: var(--fuspi-blue-dark);
            border-color: var(--fuspi-blue-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-back {
            border: 2px solid #d7ddea;
            background: #f8fafc;
            color: #374151;
        }

        .btn-back:hover {
            border-color: var(--fuspi-blue);
            background: #eef3ff;
            color: var(--fuspi-blue);
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 13px;
            border: 0;
        }

        .footer-note {
            margin-top: 24px;
            color: var(--muted);
            text-align: center;
            font-size: .82rem;
        }

        @media (max-width: 576px) {
            .page-wrap {
                padding: 18px 12px;
            }

            .card-top {
                padding: 28px 18px 26px;
            }

            .card-content {
                padding: 32px 20px 28px;
            }

            .btn-action {
                width: 100%;
                min-width: 0;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrap">
        <main class="check-card">

            <header class="card-top">
                <div class="icon-box" aria-hidden="true">⌕</div>
                <h1>Pengecekan Permohonan Mahasiswa</h1>
                <p>Fakultas Ushuluddin dan Pemikiran Islam</p>
            </header>

            <section class="card-content">

                <div class="instruction">
                    Masukkan <strong>nomor pengajuan</strong> yang Anda terima setelah
                    mengirim formulir untuk melihat status permohonan surat.
                </div>

                @if($errors->any())
                <div class="alert alert-danger mb-4">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('pemohon.lookup') }}">
                    @csrf

                    <label for="nomor_pengajuan" class="form-label">
                        Nomor Pengajuan
                    </label>

                    <input
                        id="nomor_pengajuan"
                        name="nomor_pengajuan"
                        class="form-control"
                        value="{{ old('nomor_pengajuan') }}"
                        placeholder="Contoh: FUSPI/2026/0002"
                        maxlength="120"
                        required
                        autocomplete="off">

                    <div class="action-box">
                        <button
                            type="submit"
                            style="
        display:inline-block !important;
        visibility:visible !important;
        opacity:1 !important;
        min-width:240px;
        padding:13px 22px;
        border:2px solid #4169E1;
        border-radius:12px;
        background:#4169E1;
        color:#ffffff;
        font-weight:700;
        cursor:pointer;
    ">
                            Cek Surat Permohonan
                        </button>

                        <a href="{{ route('pengajuan.index') }}"
                            class="btn btn-action btn-back">
                            ( ← Kembali ke Form Pengajuan )
                        </a>
                    </div>
                </form>

                <div class="footer-note">
                    Pastikan nomor pengajuan dimasukkan sesuai dengan nomor yang diterima saat pengajuan.
                </div>

            </section>
        </main>
    </div>
</body>

</html>