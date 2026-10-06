<div style="font-family:DejaVu Sans, sans-serif; line-height:1.6; color:#222">
<h2 style="text-align:center">DRAF SURAT {{ strtoupper(str_replace('_',' ', $pengajuan->jenis_layanan)) }}</h2>
<p style="text-align:center">Nomor pengajuan: {{ $pengajuan->nomor_pengajuan }}</p><hr>
<p style="text-align:justify; text-justify:inter-word; margin-bottom:12px;">Yang berkepentingan adalah mahasiswa berikut:</p>
<table style="width:100%">
@foreach(['nama_mahasiswa'=>'Nama','nim'=>'NIM','prodi'=>'Program studi','tujuan_surat'=>'Kepada','keperluan'=>'Keperluan','dosen_pembimbing'=>'Dosen pembimbing','mata_kuliah'=>'Mata kuliah','judul_skripsi'=>'Judul skripsi','tempat_penelitian'=>'Tempat penelitian'] as $key=>$label)
@if($pengajuan->{$key})<tr><td style="width:35%;vertical-align:top">{{ $label }}</td><td style="vertical-align:top">: {{ $pengajuan->{$key} }}</td></tr>@endif
@endforeach
</table>
<p style="margin-top:24px; text-align:justify; text-justify:inter-word; line-height:1.6;">Dokumen ini merupakan draf berdasarkan isian mahasiswa. Nomor surat resmi, redaksi, dan pejabat penandatangan harus diperiksa sebelum diterbitkan.</p>
</div>
