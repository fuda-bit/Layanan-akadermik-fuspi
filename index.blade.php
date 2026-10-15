@extends('layouts.admin')
@section('title', 'Pengajuan Surat')
@section('page_heading', 'Pengajuan Surat Mahasiswa')
@section('content')
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
<div class="card"><div class="card-body table-responsive">
<table class="table table-striped table-bordered">
<thead><tr><th>No.</th><th>Nomor pengajuan</th><th>Nama / NIM</th><th>Layanan</th><th>Status</th><th>Diajukan</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($pengajuan as $item)
<tr><td>{{ $pengajuan->firstItem() + $loop->index }}</td><td>{{ $item->nomor_pengajuan }}</td><td>{{ $item->nama_mahasiswa }}<br><small>{{ $item->nim }}</small></td><td>{{ ucwords(str_replace('_', ' ', $item->jenis_layanan)) }}</td><td>{{ $item->status }}</td><td>{{ $item->created_at?->format('d-m-Y H:i') }}</td>
<td><a class="btn btn-sm btn-primary" href="{{ route('admin.berkas.show', $item) }}">Periksa</a></td></tr>
@empty <tr><td colspan="7" class="text-center">Belum ada pengajuan.</td></tr>
@endforelse
</tbody></table>{{ $pengajuan->links() }}
</div></div>
@if($pengajuan->total() > 0)
<div class="card border-danger"><div class="card-body"><h2 class="h5 text-danger">Hapus seluruh pengajuan</h2><p>Tindakan ini menghapus seluruh data pengajuan dan berkas terkait. Ketik <strong>HAPUS SEMUA</strong> untuk melanjutkan.</p>
<form method="POST" action="{{ route('admin.berkas.destroyAll') }}" onsubmit="return confirm('Hapus seluruh pengajuan dan berkas?')">@csrf @method('DELETE')<input class="form-control mb-2" name="confirmation" autocomplete="off" required><button class="btn btn-danger">Hapus semua</button></form>
</div></div>
@endif
@endsection
