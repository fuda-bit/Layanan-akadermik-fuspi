@extends('layouts.admin')

@section('title', 'Cek Upload Berkas')
@section('page_heading', 'Daftar Berkas Terunggah')

@section('content')
<div class="card">
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pengguna</th>
          <th>Nama File</th>
          <th>Tanggal Upload</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($berkas ?? [] as $key => $item)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->nama_berkas }}</td>
            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
            <td>
              <a href="{{ asset('storage/' . $item->path_file) }}" target="_blank" class="btn btn-sm btn-primary">
                <i class="fas fa-download"></i> Lihat/Download
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Belum ada berkas yang diunggah.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection