@extends('layouts.admin')
@section('title', 'Detail Pengajuan')
@section('page_heading', 'Periksa Pengajuan')
@section('content')
<a class="btn btn-outline-secondary mb-3" href="{{ route('admin.berkas.index') }}">Kembali</a>
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card"><div class="card-body"><h2 class="h5">{{ $pengajuan->nomor_pengajuan }} — {{ $pengajuan->nama_mahasiswa }}</h2>
<dl class="row">
@foreach(['nim'=>'NIM','email'=>'Email','prodi'=>'Program studi','jenis_layanan'=>'Layanan','keperluan'=>'Keperluan','tujuan_surat'=>'Kepada','dosen_pembimbing'=>'Dosen pembimbing','mata_kuliah'=>'Mata kuliah','judul_skripsi'=>'Judul skripsi','tempat_penelitian'=>'Tempat penelitian','status'=>'Status'] as $key=>$label)
@if($pengajuan->{$key})<dt class="col-sm-3">{{ $label }}</dt><dd class="col-sm-9">{{ $pengajuan->{$key} }}</dd>@endif
@endforeach
</dl><h3 class="h6">Berkas mahasiswa</h3>
@foreach(['file_ukt'=>'Bukti UKT','file_sk_ortu'=>'SK terakhir orang tua','file_pendukung'=>'Berkas pendukung'] as $key=>$label)
@if($pengajuan->{$key})<a class="btn btn-outline-primary btn-sm mb-2" href="{{ route('admin.berkas.file', [$pengajuan, $key]) }}" target="_blank" rel="noopener">{{ $label }}</a>@endif
@endforeach
</div></div>
<div class="card"><div class="card-body"><h3 class="h5">Pratinjau surat</h3><p>Pratinjau ini adalah draf dari data pengajuan. Periksa dan lengkapi surat resmi sebelum disahkan.</p>
@include('admin.pengajuan.surat')
<a class="btn btn-primary mt-3" href="{{ route('admin.berkas.docx', $pengajuan) }}">Ekspor DOCX</a>
<a class="btn btn-outline-primary mt-3" href="{{ route('admin.berkas.pdf', $pengajuan) }}">Ekspor PDF</a>
</div></div>
<div class="card"><div class="card-body"><h3 class="h5">Surat yang sudah distempel dan ditandatangani</h3>
@if($pengajuan->surat_disahkan)<a href="{{ route('admin.berkas.file', [$pengajuan, 'surat_disahkan']) }}" target="_blank" rel="noopener">Lihat surat disahkan</a>@endif
<form method="POST" action="{{ route('admin.berkas.upload', $pengajuan) }}" enctype="multipart/form-data">@csrf
<label for="surat_disahkan">Unggah PDF surat yang sudah disahkan (maksimal 10 MB)</label>
<input type="file" id="surat_disahkan" name="surat_disahkan" accept=".pdf" class="form-control mb-2" required><button class="btn btn-success">Unggah surat</button></form>
</div></div>
<form method="POST" action="{{ route('admin.berkas.destroy', $pengajuan) }}" onsubmit="return confirm('Hapus pengajuan ini beserta berkasnya?')">@csrf @method('DELETE')<button class="btn btn-danger">Hapus pengajuan ini</button></form>
@endsection
