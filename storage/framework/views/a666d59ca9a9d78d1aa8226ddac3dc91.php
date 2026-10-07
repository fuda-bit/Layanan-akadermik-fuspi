<?php $__env->startSection('title', 'Upload Surat Permohonan Final'); ?>
<?php $__env->startSection('page_heading', 'Upload Surat Permohonan Final'); ?>
<?php $__env->startSection('content'); ?>
<style>
.final-page{--blue:#4169E1;--dark:#3155c6;--gold:#FDBE00;max-width:1050px;margin:0 auto}.final-hero{position:relative;padding:30px 24px;text-align:center;color:#fff;border-radius:20px;background:linear-gradient(135deg,var(--blue),var(--dark));box-shadow:0 16px 38px rgba(31,41,55,.12)}.final-hero:after{content:"";position:absolute;bottom:0;left:50%;width:70px;height:5px;border-radius:99px;background:var(--gold);transform:translate(-50%,50%)}.final-icon{width:62px;height:62px;margin:0 auto 13px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.5);border-radius:17px;background:rgba(255,255,255,.13);font-size:25px}.final-hero h2{margin:0;font-size:1.55rem;font-weight:800;text-transform:uppercase}.final-hero p{margin:8px 0 0;opacity:.92}.final-panel{margin-top:22px;padding:25px;border:1px solid #e5eaf3;border-radius:18px;background:#fff;box-shadow:0 10px 28px rgba(31,41,55,.07)}.final-info{margin-bottom:22px;padding:15px 18px;border:1px solid #dbe4ff;border-radius:13px;background:#f7f9ff;color:#4b5563;text-align:center}.request-card{margin-bottom:16px;padding:20px;border:1px solid #e3e8f2;border-radius:15px}.request-head{display:flex;flex-wrap:wrap;justify-content:space-between;gap:12px;margin-bottom:14px;padding-bottom:13px;border-bottom:1px solid #edf0f5}.request-number{color:var(--dark);font-weight:800}.request-name{font-weight:700}.upload-box{padding:17px;border-radius:13px;background:#f8fafc}.upload-box label{font-weight:700}.upload-box .form-control{border:2px solid #e3e8f2;border-radius:10px}.btn-final{border-radius:10px;font-weight:700}.btn-upload{background:var(--blue);border-color:var(--blue);color:#fff}@media(max-width:576px){.final-panel{padding:18px}.upload-actions .btn{width:100%}}
</style>
<div class="final-page">
<section class="final-hero"><div class="final-icon"><i class="fas fa-file-upload"></i></div><h2>Upload Surat Permohonan Final</h2><p>Surat yang telah ditandatangani dan distempel</p></section>
<section class="final-panel">
<div class="final-info">Pilih permohonan, lalu unggah <strong>PDF surat final</strong> yang sudah ditandatangani pejabat berwenang dan dibubuhi stempel fakultas.</div>
<?php if($errors->any()): ?><div class="alert alert-danger"><?php echo e($errors->first()); ?></div><?php endif; ?>
<?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
<?php $__empty_1 = true; $__currentLoopData = $pengajuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengajuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<?php
$berkasValid=$pengajuan->file_ukt && $pengajuan->validasi_ukt==='valid' && ($pengajuan->jenis_layanan!=='aktif_kuliah_tunjangan_ortu' || ($pengajuan->file_sk_ortu && $pengajuan->validasi_sk_ortu==='valid'));
$dataLengkap=\App\Support\SuratResmi::complete($pengajuan);
?>
<div class="request-card">
<div class="request-head"><div><div class="request-number"><?php echo e($pengajuan->nomor_pengajuan); ?></div><div class="request-name"><?php echo e($pengajuan->nama_mahasiswa); ?></div><small class="text-muted"><?php echo e($pengajuan->nim); ?> · <?php echo e($pengajuan->prodi); ?></small></div><div><?php if($pengajuan->surat_disahkan): ?><span class="badge badge-success">Surat Final Tersedia</span><?php else: ?><span class="badge badge-warning">Belum Upload Final</span><?php endif; ?></div></div>
<?php if($berkasValid && $dataLengkap): ?>
<div class="upload-box"><form method="POST" action="<?php echo e(route('admin.berkas.upload',$pengajuan)); ?>" enctype="multipart/form-data"><?php echo csrf_field(); ?>
<label for="surat_<?php echo e($pengajuan->id); ?>">PDF Surat Final (maksimal 10 MB)</label><input id="surat_<?php echo e($pengajuan->id); ?>" type="file" name="surat_disahkan" accept=".pdf,application/pdf" class="form-control mt-2" required>
<div class="d-flex flex-wrap upload-actions mt-3" style="gap:10px"><button class="btn btn-final btn-upload"><i class="fas fa-upload mr-1"></i><?php echo e($pengajuan->surat_disahkan ? 'Ganti Surat Final' : 'Upload Surat Final'); ?></button>
<?php if($pengajuan->surat_disahkan): ?><a class="btn btn-outline-primary btn-final" href="<?php echo e(route('admin.berkas.file',[$pengajuan,'surat_disahkan'])); ?>" target="_blank" rel="noopener"><i class="fas fa-eye mr-1"></i>Lihat Surat Final</a><?php endif; ?></div></form></div>
<?php else: ?><div class="alert alert-warning mb-0">Belum dapat diunggah: validasi berkas atau data surat resmi belum lengkap.</div><?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><div class="alert alert-info text-center">Belum ada permohonan.</div><?php endif; ?>
<?php if(method_exists($pengajuans,'links')): ?><div class="mt-3"><?php echo e($pengajuans->links()); ?></div><?php endif; ?>
<div class="text-center mt-4"><a class="btn btn-outline-secondary btn-final" href="<?php echo e(route('admin.dashboard')); ?>">( ← Kembali ke Dashboard )</a></div>
</section></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-fuspi-laravel10\resources\views/admin/pengajuan/upload-final.blade.php ENDPATH**/ ?>