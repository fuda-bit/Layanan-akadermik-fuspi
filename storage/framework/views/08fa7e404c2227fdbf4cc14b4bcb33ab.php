<?php $__env->startSection('title', 'Dashboard Admin FUSPI'); ?>
<?php $__env->startSection('page_heading', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<style>
  .fuspi-dashboard { --fuspi-blue:#4169e1; --fuspi-ink:#18243b; --fuspi-muted:#66748a; }
  .fuspi-hero { background:linear-gradient(115deg,#3659c8 0%,#4169e1 62%,#5b81ee 100%); color:#fff; border-radius:18px; padding:34px 24px; text-align:center; box-shadow:0 12px 30px rgba(65,105,225,.17); }
  .fuspi-hero h2 { font-size:1.85rem; font-weight:700; margin:0 0 8px; }
  .fuspi-hero p { margin:0; opacity:.92; }
  .fuspi-stat { background:#fff; border:1px solid #e8edf5; border-radius:15px; padding:22px; height:100%; box-shadow:0 6px 18px rgba(20,40,80,.05); }
  .fuspi-stat .stat-top { display:flex; align-items:center; justify-content:space-between; gap:12px; }
  .fuspi-stat .stat-label { color:var(--fuspi-muted); font-weight:600; margin:0; }
  .fuspi-stat .stat-icon { width:42px; height:42px; border-radius:12px; display:inline-flex; align-items:center; justify-content:center; font-size:18px; }
  .fuspi-stat .stat-number { color:var(--fuspi-ink); font-size:2.5rem; font-weight:700; line-height:1.1; margin:15px 0 7px; }
  .fuspi-stat .stat-note { color:var(--fuspi-muted); font-size:.9rem; margin:0; }
  .fuspi-stat.total { border-top:4px solid #4169e1; } .fuspi-stat.total .stat-icon { color:#4169e1; background:#eaf0ff; }
  .fuspi-stat.process { border-top:4px solid #e9a72c; } .fuspi-stat.process .stat-icon { color:#a97100; background:#fff4db; }
  .fuspi-stat.done { border-top:4px solid #27a778; } .fuspi-stat.done .stat-icon { color:#168158; background:#def6ec; }
  .fuspi-actions { background:#fff; border:1px solid #e8edf5; border-radius:15px; padding:22px; }
  .fuspi-actions h3 { color:var(--fuspi-ink); font-size:1.1rem; font-weight:700; margin:0 0 15px; }
  .fuspi-actions .btn { border-radius:9px; font-weight:600; }
  @media (max-width:575px) { .fuspi-hero { padding:27px 18px; } .fuspi-hero h2 { font-size:1.5rem; } }
</style>
<div class="fuspi-dashboard pb-4">
  <section class="fuspi-hero mb-4" aria-labelledby="welcome-title">
    <h2 id="welcome-title">Selamat Datang, Admin</h2>
    <p>Kelola permohonan surat akademik Fakultas Ushuluddin dan Pemikiran Islam.</p>
  </section>

  <div class="row mb-4" aria-label="Ringkasan status pengajuan">
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="fuspi-stat total">
        <div class="stat-top"><p class="stat-label">Total Pengajuan</p><span class="stat-icon"><i class="fas fa-folder-open" aria-hidden="true"></i></span></div>
        <div class="stat-number"><?php echo e(number_format($jumlahPengajuan)); ?></div>
        <p class="stat-note">Semua permohonan yang tercatat</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="fuspi-stat process">
        <div class="stat-top"><p class="stat-label">Sedang Diproses</p><span class="stat-icon"><i class="fas fa-hourglass-half" aria-hidden="true"></i></span></div>
        <div class="stat-number"><?php echo e(number_format($jumlahDiproses)); ?></div>
        <p class="stat-note">Belum ada surat final yang diunggah</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
      <div class="fuspi-stat done">
        <div class="stat-top"><p class="stat-label">Selesai Diproses</p><span class="stat-icon"><i class="fas fa-circle-check" aria-hidden="true"></i></span></div>
        <div class="stat-number"><?php echo e(number_format($jumlahSelesai)); ?></div>
        <p class="stat-note">Surat final sudah diunggah</p>
      </div>
    </div>
  </div>

  <section class="fuspi-actions" aria-label="Akses cepat">
    <h3>Akses Cepat</h3>
    <div class="d-flex flex-wrap" style="gap:10px">
      <a class="btn btn-primary" href="<?php echo e(route('admin.berkas.index')); ?>"><i class="fas fa-file-circle-check mr-2" aria-hidden="true"></i>Cek Berkas Pengajuan</a>
      <a class="btn btn-outline-primary" href="<?php echo e(route('pengajuan.index')); ?>"><i class="fas fa-pen-to-square mr-2" aria-hidden="true"></i>Buka Form Permohonan</a>
      <a class="btn btn-success" href="<?php echo e(route('admin.surat-final.index')); ?>"><i class="fas fa-file-upload mr-2" aria-hidden="true"></i>Upload Surat Permohonan Final</a>
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-fuspi-laravel10\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>