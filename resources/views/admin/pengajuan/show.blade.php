@extends('layouts.admin')
@section('title', 'Detail Pengajuan')
@section('page_heading', 'Periksa Pengajuan')
@section('content')
<a class="btn btn-outline-secondary mb-3" href="{{ route('admin.berkas.index') }}">Kembali</a>
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card"><div class="card-body"><h2 class="h5">{{ $pengajuan->nomor_pengajuan }} — {{ $pengajuan->nama_mahasiswa }}</h2>
<dl class="row">
@foreach(['nim'=>'NIM','email'=>'Email','prodi'=>'Program studi','semester'=>'Semester','tempat_lahir'=>'Tempat lahir','tanggal_lahir'=>'Tanggal lahir','jenis_layanan'=>'Layanan','keperluan'=>'Keperluan','tujuan_surat'=>'Kepada','dosen_pembimbing'=>'Dosen pembimbing','mata_kuliah'=>'Mata kuliah','judul_skripsi'=>'Judul skripsi','tempat_penelitian'=>'Tempat penelitian','status'=>'Status'] as $key=>$label)
@if($pengajuan->{$key})<dt class="col-sm-3">{{ $label }}</dt><dd class="col-sm-9">{{ $pengajuan->{$key} }}</dd>@endif
@endforeach
</dl><h3 class="h6">Periksa dan validasi berkas mahasiswa</h3>
@foreach(['file_ukt'=>['Bukti bayar UKT','validasi_ukt'], 'file_sk_ortu'=>['SK terakhir orang tua','validasi_sk_ortu']] as $key=>$detail)
@if($key === 'file_ukt' || $pengajuan->jenis_layanan === 'aktif_kuliah_tunjangan_ortu')
<div class="border rounded p-3 mb-3">
  <strong>{{ $detail[0] }}</strong> —
  @if($pengajuan->{$key})
    <a href="{{ route('admin.berkas.file', [$pengajuan, $key]) }}" target="_blank" rel="noopener">Buka berkas</a>
    <span class="badge badge-{{ $pengajuan->{$detail[1]} === 'valid' ? 'success' : ($pengajuan->{$detail[1]} === 'perlu_perbaikan' ? 'danger' : 'secondary') }} ml-2">{{ $pengajuan->{$detail[1]} === 'valid' ? 'Valid' : ($pengajuan->{$detail[1]} === 'perlu_perbaikan' ? 'Perlu perbaikan' : 'Belum diperiksa') }}</span>
    <form method="POST" action="{{ route('admin.berkas.validasi', [$pengajuan, $key]) }}" class="mt-2">@csrf
      <button name="keputusan" value="valid" class="btn btn-success btn-sm">Tandai valid</button>
      <button name="keputusan" value="perlu_perbaikan" class="btn btn-warning btn-sm">Perlu perbaikan</button>
    </form>
  @else
    <span class="text-danger">Belum diunggah; tidak dapat divalidasi.</span>
  @endif
</div>
@endif
@endforeach
@if($pengajuan->file_pendukung)<a class="btn btn-outline-primary btn-sm mb-2" href="{{ route('admin.berkas.file', [$pengajuan, 'file_pendukung']) }}" target="_blank" rel="noopener">Berkas pendukung</a>@endif
</div></div>
@php
  $berkasValid = $pengajuan->file_ukt && $pengajuan->validasi_ukt === 'valid'
    && ($pengajuan->jenis_layanan !== 'aktif_kuliah_tunjangan_ortu' || ($pengajuan->file_sk_ortu && $pengajuan->validasi_sk_ortu === 'valid'));
  $dataSurat = $pengajuan->data_surat ?? [];
  $dataLengkap = \App\Support\SuratResmi::complete($pengajuan);
@endphp
@unless($berkasValid)<div class="alert alert-warning">Validasi seluruh berkas wajib sebelum mengekspor atau mengunggah surat yang disahkan.</div>@endunless
<div class="card"><div class="card-body"><h3 class="h5">Lengkapi data surat resmi</h3>
<p>Nomor pengajuan berbeda dari nomor surat resmi. Periksa data mahasiswa dan isi nomor surat yang telah ditetapkan fakultas.</p>
@if($pengajuan->jenis_layanan === 'magang' && $tanggalMagang && (empty($dataSurat['tanggal_mulai']) || empty($dataSurat['tanggal_selesai'])))
<div class="alert alert-info">Tanggal magang disarankan dari teks keperluan. Periksa tanggal mulai dan selesai, lalu simpan data surat.</div>
@endif
<form method="POST" action="{{ route('admin.berkas.dataSurat', $pengajuan) }}">@csrf
<div class="row">
@foreach(['nomor_surat'=>'Nomor surat resmi', 'tanggal_surat'=>'Tanggal surat'] as $key=>$label)
<div class="col-md-6 mb-3"><label for="{{ $key }}">{{ $label }} *</label><input class="form-control" id="{{ $key }}" name="{{ $key }}" type="{{ $key === 'tanggal_surat' ? 'date' : 'text' }}" value="{{ old($key, $dataSurat[$key] ?? '') }}" required></div>
@endforeach
@if(!$pengajuan->tempat_lahir || !$pengajuan->tanggal_lahir || !$pengajuan->semester || (in_array($pengajuan->jenis_layanan, ['magang', 'observasi'], true) && !$pengajuan->dosen_pembimbing))
<div class="col-12"><p class="alert alert-info">Pengajuan lama: lengkapi identitas yang belum tercatat sebelum menerbitkan surat.</p></div>
@endif
@foreach(['tempat_lahir'=>'Tempat lahir','tanggal_lahir'=>'Tanggal lahir','semester'=>'Semester'] as $key=>$label)
@if(!$pengajuan->{$key})<div class="col-md-6 mb-3"><label for="{{ $key }}">{{ $label }} *</label><input class="form-control" id="{{ $key }}" name="{{ $key }}" type="{{ $key === 'tanggal_lahir' ? 'date' : 'text' }}" value="{{ old($key, $pengajuan->{$key}) }}" required></div>
@else<input type="hidden" name="{{ $key }}" value="{{ $key === 'tanggal_lahir' ? $pengajuan->{$key}->format('Y-m-d') : $pengajuan->{$key} }}">@endif
@endforeach
@if(in_array($pengajuan->jenis_layanan, ['magang', 'observasi'], true))
@if(!$pengajuan->dosen_pembimbing)<div class="col-md-6 mb-3"><label for="dosen_pembimbing">Dosen pembimbing *</label><input class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" value="{{ old('dosen_pembimbing') }}" required></div>
@else<input type="hidden" name="dosen_pembimbing" value="{{ $pengajuan->dosen_pembimbing }}">@endif
@endif
@if(str_starts_with($pengajuan->jenis_layanan, 'aktif_kuliah_'))
@foreach(['semester_akademik'=>'Semester akademik (Ganjil/Genap)', 'tahun_akademik'=>'Tahun akademik (contoh: 2026/2027)'] as $key=>$label)
<div class="col-md-6 mb-3"><label for="{{ $key }}">{{ $label }} *</label><input class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $dataSurat[$key] ?? '') }}" required></div>
@endforeach
@endif
@if($pengajuan->jenis_layanan === 'aktif_kuliah_tunjangan_ortu')
@foreach(['nama_orang_tua'=>'Nama orang tua *','nip_orang_tua'=>'NIP orang tua (jika ada)','pangkat_orang_tua'=>'Pangkat/golongan (jika ada)','instansi_orang_tua'=>'Instansi orang tua *'] as $key=>$label)
<div class="col-md-6 mb-3"><label for="{{ $key }}">{{ $label }}</label><input class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $dataSurat[$key] ?? '') }}" @if(in_array($key,['nama_orang_tua','instansi_orang_tua'])) required @endif></div>
@endforeach
@endif
@if(in_array($pengajuan->jenis_layanan, ['magang', 'observasi'], true))
@foreach(['tanggal_mulai'=>'Tanggal mulai pelaksanaan','tanggal_selesai'=>'Tanggal selesai pelaksanaan'] as $key=>$label)
<div class="col-md-6 mb-3"><label for="{{ $key }}">{{ $label }} *</label><input class="form-control" id="{{ $key }}" name="{{ $key }}" type="date" value="{{ old($key, $dataSurat[$key] ?? $tanggalMagang[$key] ?? '') }}" required></div>
@endforeach
@endif
</div><button class="btn btn-primary">Simpan data surat</button></form>
</div></div>
@unless($dataLengkap)<div class="alert alert-warning">Data surat resmi belum lengkap. Simpan data surat sebelum mengekspor atau mengunggah surat.</div>@endunless
<div class="card"><div class="card-body"><h3 class="h5">Pratinjau surat sesuai layanan</h3><p>Periksa redaksi, identitas, dan pejabat penandatangan sebelum surat diterbitkan.</p>
@include('admin.pengajuan.surat')
@if($berkasValid && $dataLengkap)
<div class="mt-3 d-flex flex-wrap gap-2">
    <a class="btn btn-primary" href="{{ route('admin.berkas.docx', $pengajuan) }}">
        Ekspor DOCX
    </a>

    <a class="btn btn-outline-primary" href="{{ route('admin.berkas.pdf', $pengajuan) }}">
        Preview / Download Draft PDF
    </a>

    @if($pengajuan->surat_disahkan)
        <a class="btn btn-success" href="{{ route('admin.berkas.final', $pengajuan) }}">
            Download Surat Final
        </a>
    @endif
</div>

@if(!$pengajuan->surat_disahkan)
    <div class="alert alert-info mt-3 mb-0">
        Surat final belum tersedia. Unggah surat yang sudah disahkan terlebih dahulu.
    </div>
@endif
@endif
</div></div>
<form method="POST" action="{{ route('admin.berkas.destroy', $pengajuan) }}" onsubmit="return confirm('Hapus pengajuan ini beserta berkasnya?')">@csrf @method('DELETE')<button class="btn btn-danger">Hapus pengajuan ini</button></form>
@endsection
