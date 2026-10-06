<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Berhasil</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #eef3ff 0%, #f8faff 48%, #fff8e8 100%);
            color: #1f2937;
        }
        .success-card {
            width: 100%;
            max-width: 680px;
            padding: 48px 44px 42px;
            text-align: center;
            background: rgba(255,255,255,.98);
            border: 1px solid #e5e7eb;
            border-radius: 28px;
            box-shadow: 0 24px 65px rgba(31, 55, 105, .14);
        }
        .success-icon {
            width: 86px;
            height: 86px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #eef3ff;
            border: 2px solid #4169E1;
            color: #4169E1;
            font-size: 45px;
            font-weight: 700;
            line-height: 1;
        }
        h1 {
            margin-bottom: 16px;
            color: #4169E1;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: .4px;
            text-transform: uppercase;
        }
        .message {
            max-width: 540px;
            margin: 0 auto 30px;
            color: #374151;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.55;
            text-transform: uppercase;
        }
        .ticket {
            position: relative;
            margin: 0 auto 34px;
            padding: 25px 42px;
            overflow: hidden;
            background: #f7f9ff;
            border: 2px dashed #4169E1;
            border-radius: 18px;
        }
        .ticket::before, .ticket::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 28px;
            height: 28px;
            background: #fff;
            border: 1px solid #dfe5f3;
            border-radius: 50%;
            transform: translateY(-50%);
        }
        .ticket::before { left: -15px; }
        .ticket::after { right: -15px; }
        .ticket-label {
            margin-bottom: 9px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .ticket-number {
            color: #1f3f9b;
            font-size: 31px;
            font-weight: 800;
            letter-spacing: 1.5px;
            overflow-wrap: anywhere;
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 220px;
            padding: 15px 26px;
            color: #fff;
            background: #4169E1;
            border: 2px solid #4169E1;
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(65, 105, 225, .25);
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }
        .back-button:hover {
            background: #3156c9;
            border-color: #3156c9;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(65, 105, 225, .30);
        }
        @media (max-width: 600px) {
            body { padding: 16px; }
            .success-card { padding: 38px 22px 32px; border-radius: 22px; }
            .success-icon { width: 74px; height: 74px; font-size: 38px; }
            h1 { font-size: 26px; }
            .message { font-size: 17px; }
            .ticket { padding: 22px 25px; }
            .ticket-number { font-size: 24px; }
            .back-button { width: 100%; }
        }
    </style>
</head>
<body>
    <main class="success-card">
        <div class="success-icon" aria-hidden="true">✓</div>

        <h1>Pengajuan Berhasil</h1>

        <p class="message">Permohonan Surat Anda Telah Berhasil Dikirim</p>

        <section class="ticket" aria-label="Nomor pendaftaran">
            <div class="ticket-label">Nomor Pendaftaran</div>
            <div class="ticket-number">{{ session('nomor') }}</div>
        </section>

        <a class="back-button" href="{{ route('pengajuan.index') }}">( Kembali ke Formulir )</a>
    </main>
</body>
</html>
