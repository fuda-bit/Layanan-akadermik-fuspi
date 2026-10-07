<?php $__env->startSection('title', 'Detail Pengajuan'); ?>
<?php $__env->startSection('page_heading', 'Periksa Pengajuan'); ?>
<?php $__env->startSection('content'); ?>
<a class="btn btn-outline-secondary mb-3" href="<?php echo e(route('admin.berkas.index')); ?>">Kembali</a>
<?php if($errors->any()): ?><div class="alert alert-danger"><?php echo e($errors->first()); ?></div><?php endif; ?>
<?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
<div class="card"><div class="card-body"><h2 class="h5"><?php echo e($pengajuan->nomor_pengajuan); ?> — <?php echo e($pengajuan->nama_mahasiswa); ?></h2>
<dl class="row">
<?php $__currentLoopData = ['nim'=>'NIM','email'=>'Email','prodi'=>'Program studi','semester'=>'Semester','tempat_lahir'=>'Tempat lahir','tanggal_lahir'=>'Tanggal lahir','jenis_layanan'=>'Layanan','keperluan'=>'Keperluan','tujuan_surat'=>'Kepada','dosen_pembimbing'=>'Dosen pembimbing','mata_kuliah'=>'Mata kuliah','judul_skripsi'=>'Judul skripsi','tempat_penelitian'=>'Tempat penelitian','status'=>'Status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($pengajuan->{$key}): ?><dt class="col-sm-3"><?php echo e($label); ?></dt><dd class="col-sm-9"><?php echo e($pengajuan->{$key}); ?></dd><?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</dl><h3 class="h6">Periksa dan validasi berkas mahasiswa</h3>
<?php $__currentLoopData = ['file_ukt'=>['Bukti bayar UKT','validasi_ukt'], 'file_sk_ortu'=>['SK terakhir orang tua','validasi_sk_ortu']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($key === 'file_ukt' || $pengajuan->jenis_layanan === 'aktif_kuliah_tunjangan_ortu'): ?>
<div class="border rounded p-3 mb-3">
  <strong><?php echo e($detail[0]); ?></strong> —
  <?php if($pengajuan->{$key}): ?>
    <a href="<?php echo e(route('admin.berkas.file', [$pengajuan, $key])); ?>" target="_blank" rel="noopener">Buka berkas</a>
    <span class="badge badge-<?php echo e($pengajuan->{$detail[1]} === 'valid' ? 'success' : ($pengajuan->{$detail[1]} === 'perlu_perbaikan' ? 'danger' : 'secondary')); ?> ml-2"><?php echo e($pengajuan->{$detail[1]} === 'valid' ? 'Valid' : ($pengajuan->{$detail[1]} === 'perlu_perbaikan' ? 'Perlu perbaikan' : 'Belum diperiksa')); ?></span>
    <form method="POST" action="<?php echo e(route('admin.berkas.validasi', [$pengajuan, $key])); ?>" class="mt-2"><?php echo csrf_field(); ?>
      <button name="keputusan" value="valid" class="btn btn-success btn-sm">Tandai valid</button>
      <button name="keputusan" value="perlu_perbaikan" class="btn btn-warning btn-sm">Perlu perbaikan</button>
    </form>
  <?php else: ?>
    <span class="text-danger">Belum diunggah; tidak dapat divalidasi.</span>
  <?php endif; ?>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if($pengajuan->file_pendukung): ?><a class="btn btn-outline-primary btn-sm mb-2" href="<?php echo e(route('admin.berkas.file', [$pengajuan, 'file_pendukung'])); ?>" target="_blank" rel="noopener">Berkas pendukung</a><?php endif; ?>
</div></div>
<?php
  $berkasValid = $pengajuan->file_ukt && $pengajuan->validasi_ukt === 'valid'
    && ($pengajuan->jenis_layanan !== 'aktif_kuliah_tunjangan_ortu' || ($pengajuan->file_sk_ortu && $pengajuan->validasi_sk_ortu === 'valid'));
  $dataSurat = $pengajuan->data_surat ?? [];
  $dataLengkap = \App\Support\SuratResmi::complete($pengajuan);
?>
<?php if (! ($berkasValid)): ?><div class="alert alert-warning">Validasi seluruh berkas wajib sebelum mengekspor atau mengunggah surat yang disahkan.</div><?php endif; ?>
<div class="card"><div class="card-body"><h3 class="h5">Lengkapi data surat resmi</h3>
<p>Nomor pengajuan berbeda dari nomor surat resmi. Periksa data mahasiswa dan isi nomor surat yang telah ditetapkan fakultas.</p>
<?php if($pengajuan->jenis_layanan === 'magang' && $tanggalMagang && (empty($dataSurat['tanggal_mulai']) || empty($dataSurat['tanggal_selesai']))): ?>
<div class="alert alert-info">Tanggal magang disarankan dari teks keperluan. Periksa tanggal mulai dan selesai, lalu simpan data surat.</div>
<?php endif; ?>
<form method="POST" action="<?php echo e(route('admin.berkas.dataSurat', $pengajuan)); ?>"><?php echo csrf_field(); ?>
<div class="row">
<?php $__currentLoopData = ['nomor_surat'=>'Nomor surat resmi', 'tanggal_surat'=>'Tanggal surat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-6 mb-3"><label for="<?php echo e($key); ?>"><?php echo e($label); ?> *</label><input class="form-control" id="<?php echo e($key); ?>" name="<?php echo e($key); ?>" type="<?php echo e($key === 'tanggal_surat' ? 'date' : 'text'); ?>" value="<?php echo e(old($key, $dataSurat[$key] ?? '')); ?>" required></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(!$pengajuan->tempat_lahir || !$pengajuan->tanggal_lahir || !$pengajuan->semester || (in_array($pengajuan->jenis_layanan, ['magang', 'observasi'], true) && !$pengajuan->dosen_pembimbing)): ?>
<div class="col-12"><p class="alert alert-info">Pengajuan lama: lengkapi identitas yang belum tercatat sebelum menerbitkan surat.</p></div>
<?php endif; ?>
<?php $__currentLoopData = ['tempat_lahir'=>'Tempat lahir','tanggal_lahir'=>'Tanggal lahir','semester'=>'Semester']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!$pengajuan->{$key}): ?><div class="col-md-6 mb-3"><label for="<?php echo e($key); ?>"><?php echo e($label); ?> *</label><input class="form-control" id="<?php echo e($key); ?>" name="<?php echo e($key); ?>" type="<?php echo e($key === 'tanggal_lahir' ? 'date' : 'text'); ?>" value="<?php echo e(old($key, $pengajuan->{$key})); ?>" required></div>
<?php else: ?><input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($key === 'tanggal_lahir' ? $pengajuan->{$key}->format('Y-m-d') : $pengajuan->{$key}); ?>"><?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if(in_array($pengajuan->jenis_layanan, ['magang', 'observasi'], true)): ?>
<?php if(!$pengajuan->dosen_pembimbing): ?><div class="col-md-6 mb-3"><label for="dosen_pembimbing">Dosen pembimbing *</label><input class="form-control" id="dosen_pembimbing" name="dosen_pembimbing" value="<?php echo e(old('dosen_pembimbing')); ?>" required></div>
<?php else: ?><input type="hidden" name="dosen_pembimbing" value="<?php echo e($pengajuan->dosen_pembimbing); ?>"><?php endif; ?>
<?php endif; ?>
<?php if(str_starts_with($pengajuan->jenis_layanan, 'aktif_kuliah_')): ?>
<?php $__currentLoopData = ['semester_akademik'=>'Semester akademik (Ganjil/Genap)', 'tahun_akademik'=>'Tahun akademik (contoh: 2026/2027)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-6 mb-3"><label for="<?php echo e($key); ?>"><?php echo e($label); ?> *</label><input class="form-control" id="<?php echo e($key); ?>" name="<?php echo e($key); ?>" value="<?php echo e(old($key, $dataSurat[$key] ?? '')); ?>" required></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if($pengajuan->jenis_layanan === 'aktif_kuliah_tunjangan_ortu'): ?>
<?php $__currentLoopData = ['nama_orang_tua'=>'Nama orang tua *','nip_orang_tua'=>'NIP orang tua (jika ada)','pangkat_orang_tua'=>'Pangkat/golongan (jika ada)','instansi_orang_tua'=>'Instansi orang tua *']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-6 mb-3"><label for="<?php echo e($key); ?>"><?php echo e($label); ?></label><input class="form-control" id="<?php echo e($key); ?>" name="<?php echo e($key); ?>" value="<?php echo e(old($key, $dataSurat[$key] ?? '')); ?>" <?php if(in_array($key,['nama_orang_tua','instansi_orang_tua'])): ?> required <?php endif; ?>></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if(in_array($pengajuan->jenis_layanan, ['magang', 'observasi'], true)): ?>
<?php $__currentLoopData = ['tanggal_mulai'=>'Tanggal mulai pelaksanaan','tanggal_selesai'=>'Tanggal selesai pelaksanaan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-6 mb-3"><label for="<?php echo e($key); ?>"><?php echo e($label); ?> *</label><input class="form-control" id="<?php echo e($key); ?>" name="<?php echo e($key); ?>" type="date" value="<?php echo e(old($key, $dataSurat[$key] ?? $tanggalMagang[$key] ?? '')); ?>" required></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</div><button class="btn btn-primary">Simpan data surat</button></form>
</div></div>
<?php if (! ($dataLengkap)): ?><div class="alert alert-warning">Data surat resmi belum lengkap. Simpan data surat sebelum mengekspor atau mengunggah surat.</div><?php endif; ?>
<div class="card"><div class="card-body"><h3 class="h5">Pratinjau surat sesuai layanan</h3><p>Periksa redaksi, identitas, dan pejabat penandatangan sebelum surat diterbitkan.</p>
<?php echo $__env->make('admin.pengajuan.surat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($berkasValid && $dataLengkap): ?>
<div class="mt-3 d-flex flex-wrap gap-2">
    <a class="btn btn-primary" href="<?php echo e(route('admin.berkas.docx', $pengajuan)); ?>">
        Ekspor DOCX
    </a>

    <a class="btn btn-outline-primary" href="<?php echo e(route('admin.berkas.pdf', $pengajuan)); ?>">
        Preview / Download Draft PDF
    </a>

    <?php if($pengajuan->surat_disahkan): ?>
        <a class="btn btn-success" href="<?php echo e(route('admin.berkas.final', $pengajuan)); ?>">
            Download Surat Final
        </a>
    <?php endif; ?>
</div>

<?php if(!$pengajuan->surat_disahkan): ?>
    <div class="alert alert-info mt-3 mb-0">
        Surat final belum tersedia. Unggah surat yang sudah disahkan terlebih dahulu.
    </div>
<?php endif; ?>
<?php endif; ?>
</div></div>
<form method="POST" action="<?php echo e(route('admin.berkas.destroy', $pengajuan)); ?>" onsubmit="return confirm('Hapus pengajuan ini beserta berkasnya?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger">Hapus pengajuan ini</button></form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-fuspi-laravel10\resources\views/admin/pengajuan/show.blade.php ENDPATH**/ ?>