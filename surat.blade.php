@php
    $surat = \App\Support\SuratResmi::values($pengajuan);
@endphp
<div style="background:#fff;color:#111;font-family:'Times New Roman',DejaVu Serif,serif;font-size:12pt;line-height:1.4;padding:24px;max-width:794px;margin:0 auto">
@if(!empty($kop))
    <img src="data:image/jpeg;base64,{{ $kop }}" alt="Kop Fakultas Ushuluddin dan Pemikiran Islam" style="width:100%;height:auto;margin-bottom:18px">
@endif
@switch($pengajuan->jenis_layanan)
@case('aktif_kuliah_umum')



<p style="margin:0 0 10px;text-align:center"><strong>SURAT KETERANGAN MASIH AKTIF KULIAH</strong></p>
<p style="margin:0 0 10px;text-align:center">NOMOR: {{ $surat['nomor_surat'] ?? '' }}</p>


<p style="margin:0 0 10px;text-align:left">Yang bertanda tangan di bawah ini:</p>
<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:right"><strong>MASRUKHIN MUHSIN</strong></p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIP</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">197202021999031004</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Pangkat/Golongan</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Pembina Utama Muda/IV.c</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Jabatan</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Wakil Dekan I</p></td></tr></table>

<p style="margin:0 0 10px;text-align:left">Dengan ini menerangkan bahwa mahasiswa berikut:</p>
<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_mahasiswa'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Tempat/Tgl. Lahir</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['tempat_tgl_lahir'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIM</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nim'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Fakultas</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Ushuluddin dan Pemikiran Islam</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Prodi/Semester</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['prodi'] ?? '' }} / {{ $surat['semester'] ?? '' }}</p></td></tr></table>

<p style="margin:0 0 10px;text-align:justify">adalah mahasiswa Fakultas Ushuluddin dan Pemikiran Islam Universitas Islam Negeri Sultan Maulana Hasanuddin Banten yang masih aktif kuliah pada semester {{ $surat['semester_akademik'] ?? '' }} tahun akademik {{ $surat['tahun_akademik'] ?? '' }}.</p>

<p style="margin:0 0 10px;text-align:left">Surat keterangan ini dibuat untuk keperluan {{ $surat['keperluan'] ?? '' }}.</p>
<p style="margin:0 0 10px;text-align:left">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

<p style="margin:0 0 10px;text-align:right">Serang, {{ $surat['tanggal_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:right">a.n. Dekan<br> Wakil Dekan Bidang Akademik</p>
<p style="margin:0 0 10px;text-align:right">dan Kelembagaan,</p>



<p style="margin:36px 0 0;text-align:right"><strong>MASRUKHIN MUHSIN</strong></p>
@break
@case('aktif_kuliah_tunjangan_ortu')



<p style="margin:0 0 10px;text-align:center"><strong>SURAT KETERANGAN MASIH AKTIF KULIAH</strong></p>
<p style="margin:0 0 10px;text-align:center">NOMOR: {{ $surat['nomor_surat'] ?? '' }}</p>


<p style="margin:0 0 10px;text-align:left">Yang bertanda tangan di bawah ini:</p>
<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:right"><strong>MASRUKHIN MUHSIN</strong></p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIP</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">197202021999031004</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Pangkat/Golongan</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Pembina Utama Muda/IV.c</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Jabatan</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Wakil Dekan I</p></td></tr></table>

<p style="margin:0 0 10px;text-align:left">Dengan ini menerangkan bahwa mahasiswa berikut:</p>
<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_mahasiswa'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Tempat/Tgl. Lahir</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['tempat_tgl_lahir'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIM</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nim'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Fakultas</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Ushuluddin dan Pemikiran Islam</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Prodi/Semester</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['prodi'] ?? '' }} / {{ $surat['semester'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Data Orang Tua</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_orang_tua'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIP</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nip_orang_tua'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Pangkat/Golongan</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['pangkat_orang_tua'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Instansi Orang Tua</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['instansi_orang_tua'] ?? '' }}</p></td></tr></table>

<p style="margin:0 0 10px;text-align:justify">adalah mahasiswa Fakultas Ushuluddin dan Pemikiran Islam Universitas Islam Negeri Sultan Maulana Hasanuddin Banten yang masih aktif kuliah pada semester {{ $surat['semester_akademik'] ?? '' }} tahun akademik {{ $surat['tahun_akademik'] ?? '' }}.</p>

<p style="margin:0 0 10px;text-align:left">Surat keterangan ini dibuat untuk keperluan {{ $surat['keperluan'] ?? '' }}.</p>

<p style="margin:0 0 10px;text-align:left">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

<p style="margin:0 0 10px;text-align:right">Serang, {{ $surat['tanggal_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:right">a.n. Dekan<br> Wakil Dekan Bidang Akademik</p>
<p style="margin:0 0 10px;text-align:right">dan Kelembagaan,</p>


<p style="margin:36px 0 0;text-align:right"><strong>MASRUKHIN MUHSIN</strong></p>
@break
@case('magang')
<p style="margin:0 0 10px;text-align:left">Nomor : {{ $surat['nomor_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:left">Lampiran : -</p>
<p style="margin:0 0 10px;text-align:left">Perihal : Permohonan Magang</p>

<p style="margin:0 0 10px;text-align:left">Kepada Yth.<br>{{ $surat['tujuan_surat'] ?? '' }}<br>di</p>
<p style="margin:0 0 10px;text-align:left">Tempat</p>


<p style="margin:0 0 10px;text-align:left">Assalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:justify">Dalam rangka memenuhi kewajiban kurikulum dan meningkatkan keterampilan mahasiswa Program Studi {{ $surat['prodi'] ?? '' }} Fakultas Ushuluddin dan Pemikiran Islam, maka dengan ini kami memohon kepada Bapak/Ibu berkenan memberikan izin mahasiswa yang namanya tercantum di bawah ini untuk melakukan magang di instansi/kantor yang Bapak/Ibu pimpin.</p>

<p style="margin:0 0 10px;text-align:left">Berikut ini kami sampaikan Mahasiswa yang akan melaksanakan kegiatan tersebut :</p>
<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_mahasiswa'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Tempat/Tgl. Lahir</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['tempat_tgl_lahir'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIM</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nim'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Fakultas</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Ushuluddin dan Pemikiran Islam</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Prodi/Semester</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['prodi'] ?? '' }} / {{ $surat['semester'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Dosen Pembimbing</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['dosen_pembimbing'] ?? '' }}</p></td></tr></table>

<p style="margin:0 0 10px;text-align:left">Adapun kegiatan yang dimaksud akan dilaksanakan dari {{ $surat['tanggal_mulai'] ?? '' }} sampai dengan {{ $surat['tanggal_selesai'] ?? '' }}. Keperluan: {{ $surat['keperluan'] ?? '' }}.</p>

<p style="margin:0 0 10px;text-align:left">Demikian surat ini kami sampaikan. Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.</p>

<p style="margin:0 0 10px;text-align:left">Wassalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:right">Serang, {{ $surat['tanggal_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:right">Dekan Fakultas Ushuluddin dan Pemikiran Islam,</p>



<p style="margin:36px 0 0;text-align:right"><strong>MASYKUR</strong></p>
@break
@case('observasi')
<p style="margin:0 0 10px;text-align:left">Nomor : {{ $surat['nomor_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:left">Lampiran : -</p>
<p style="margin:0 0 10px;text-align:left">Perihal : Permohonan Observasi</p>

<p style="margin:0 0 10px;text-align:left">Kepada Yth.<br>{{ $surat['tujuan_surat'] ?? '' }}<br>di</p>
<p style="margin:0 0 10px;text-align:left">Tempat</p>


<p style="margin:0 0 10px;text-align:left">Assalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:justify">Dalam rangka memenuhi tugas observasi mata kuliah {{ $surat['mata_kuliah'] ?? '' }} Program Studi {{ $surat['prodi'] ?? '' }} Fakultas Ushuluddin dan Pemikiran Islam, maka dengan ini kami memohon kepada Bapak/Ibu berkenan memberikan izin mahasiswa yang namanya tercantum di bawah ini untuk melakukan Observasi dan Penelitian. Adapun nama mahasiswa yang dimaksud yaitu :</p>

<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_mahasiswa'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Tempat/Tgl. Lahir</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['tempat_tgl_lahir'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIM</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nim'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Fakultas</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Ushuluddin dan Pemikiran Islam</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Prodi/Semester</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['prodi'] ?? '' }} / {{ $surat['semester'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Dosen Pembimbing</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['dosen_pembimbing'] ?? '' }}</p></td></tr></table>

<p style="margin:0 0 10px;text-align:left">Keperluan observasi: {{ $surat['keperluan'] ?? '' }}.</p>

<p style="margin:0 0 10px;text-align:left">Demikian surat ini kami sampaikan. Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.</p>

<p style="margin:0 0 10px;text-align:left">Wassalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:right">Serang, {{ $surat['tanggal_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:right">a.n. Dekan<br> Wakil Dekan Bidang Akademik</p>
<p style="margin:0 0 10px;text-align:right">dan Kelembagaan,</p>



<p style="margin:36px 0 0;text-align:right"><strong>MASRUKHIN MUHSIN</strong></p>
@break
@case('penelitian')
<p style="margin:0 0 10px;text-align:left">Nomor : {{ $surat['nomor_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:left">Lampiran : -</p>
<p style="margin:0 0 10px;text-align:left">Perihal : Izin Penelitian</p>

<p style="margin:0 0 10px;text-align:left">Kepada Yth.<br>{{ $surat['tujuan_surat'] ?? '' }}<br>di</p>
<p style="margin:0 0 10px;text-align:left">Tempat</p>


<p style="margin:0 0 10px;text-align:left">Assalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:justify">Dekan Fakultas Ushuluddin dan Pemikiran Islam Universitas Islam Negeri Sultan Maulana Hasanuddin Banten memohon kepada Bapak/Ibu untuk dapat kiranya menerima Mahasiswa/i berikut ini :</p>

<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_mahasiswa'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Tempat/Tgl. Lahir</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['tempat_tgl_lahir'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIM</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nim'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Fakultas</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Ushuluddin dan Pemikiran Islam</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Prodi/Semester</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['prodi'] ?? '' }} / {{ $surat['semester'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Judul Skripsi</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['judul_skripsi'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Tempat Penelitian</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['tempat_penelitian'] ?? '' }}</p></td></tr></table>

<p style="margin:0 0 10px;text-align:justify">Akan melaksanakan wawancara kepada Bapak/Ibu untuk kepentingan Penelitian Skripsi dengan judul sebagaimana tersebut diatas. Pelaksanaan Penelitian disesuaikan dengan jadwal yang ditentukan oleh Bapak/Ibu.</p>

<p style="margin:0 0 10px;text-align:left">Demikian surat ini kami sampaikan. Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.</p>

<p style="margin:0 0 10px;text-align:left">Wassalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:right">Serang, {{ $surat['tanggal_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:right">a.n. Dekan<br> Wakil Dekan Bidang Akademik</p>
<p style="margin:0 0 10px;text-align:right">dan Kelembagaan,</p>



<p style="margin:36px 0 0;text-align:right"><strong>MASRUKHIN MUHSIN</strong></p>
@break
@case('rekomendasi')
<p style="margin:0 0 10px;text-align:left">Nomor : {{ $surat['nomor_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:left">Lampiran : -</p>
<p style="margin:0 0 10px;text-align:left">Perihal : Rekomendasi</p>


<p style="margin:0 0 10px;text-align:left">Kepada Yth.<br>{{ $surat['tujuan_surat'] ?? '' }}<br>di</p>
<p style="margin:0 0 10px;text-align:left">Tempat</p>

<p style="margin:0 0 10px;text-align:left">Assalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:left">Saya yang bertanda tangan di bawah ini, Dekan Fakultas Ushuluddin dan Pemikiran Islam, memberikan rekomendasi kepada:</p>
<table style="width:100%;border-collapse:collapse;margin:0 0 12px"><tr><td style="width:25%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Nama</p></td><td style="width:25%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:25%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_mahasiswa'] ?? '' }}</p></td><td style="width:25%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nama_mahasiswa'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Tempat/Tgl. Lahir</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['tempat_tgl_lahir'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">NIM</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['nim'] ?? '' }}</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Fakultas</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Ushuluddin dan Pemikiran Islam</p></td></tr><tr><td style="width:30%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">Prodi/Semester</p></td><td style="width:3%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">:</p></td><td style="width:67%;vertical-align:top;padding:2px 4px"><p style="margin:0;text-align:left">{{ $surat['prodi'] ?? '' }} / {{ $surat['semester'] ?? '' }}</p></td></tr></table>

<p style="margin:0 0 10px;text-align:left">Untuk keperluan {{ $surat['keperluan'] ?? '' }}.</p>

<p style="margin:0 0 10px;text-align:left">Demikian surat ini kami sampaikan. Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.</p>

<p style="margin:0 0 10px;text-align:left">Wassalamu’alaikum Wr. Wb.</p>

<p style="margin:0 0 10px;text-align:right">Serang, {{ $surat['tanggal_surat'] ?? '' }}</p>
<p style="margin:0 0 10px;text-align:right">Dekan Fakultas Ushuluddin dan Pemikiran Islam,</p>



<p style="margin:36px 0 0;text-align:right"><strong>MASYKUR</strong></p>
@break
@default
    <p>Jenis layanan tidak dikenali. Periksa data pengajuan.</p>
@endswitch
</div>
