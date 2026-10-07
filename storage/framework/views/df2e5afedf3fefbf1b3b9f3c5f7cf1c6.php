<?php $__env->startSection('title', 'Pengajuan Surat'); ?>
<?php $__env->startSection('page_heading', 'Pengajuan Surat Mahasiswa'); ?>
<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
<?php if($errors->any()): ?><div class="alert alert-danger"><?php echo e($errors->first()); ?></div><?php endif; ?>
<div class="card"><div class="card-body table-responsive">
<table class="table table-striped table-bordered">
<thead><tr><th>No.</th><th>Nomor pengajuan</th><th>Nama / NIM</th><th>Layanan</th><th>UKT</th><th>SK orang tua</th><th>Status</th><th>Diajukan</th><th>Aksi</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $pengajuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($pengajuan->firstItem() + $loop->index); ?></td><td><?php echo e($item->nomor_pengajuan); ?></td><td><?php echo e($item->nama_mahasiswa); ?><br><small><?php echo e($item->nim); ?></small></td><td><?php echo e(ucwords(str_replace('_', ' ', $item->jenis_layanan))); ?></td><td><?php echo e($item->validasi_ukt === 'valid' ? 'Valid' : ($item->validasi_ukt === 'perlu_perbaikan' ? 'Perlu perbaikan' : 'Belum diperiksa')); ?></td><td><?php echo e($item->jenis_layanan === 'aktif_kuliah_tunjangan_ortu' ? ($item->validasi_sk_ortu === 'valid' ? 'Valid' : ($item->validasi_sk_ortu === 'perlu_perbaikan' ? 'Perlu perbaikan' : 'Belum diperiksa')) : 'Tidak diperlukan'); ?></td><td><?php echo e($item->status); ?></td><td><?php echo e($item->created_at?->format('d-m-Y H:i')); ?></td>
<td>
  <div class="d-flex align-items-center" style="gap:6px;white-space:nowrap">
    <a class="btn btn-sm btn-primary" href="<?php echo e(route('admin.berkas.show', $item)); ?>">Periksa</a>
    <form method="POST" action="<?php echo e(route('admin.berkas.destroy', $item)); ?>" class="m-0" onsubmit="return confirm('Hapus pengajuan <?php echo e($item->nomor_pengajuan); ?> beserta berkas terkait? Tindakan ini tidak dapat dibatalkan.')">
      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
      <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Hapus pengajuan <?php echo e($item->nomor_pengajuan); ?>">Hapus</button>
    </form>
  </div>
</td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <tr><td colspan="9" class="text-center">Belum ada pengajuan.</td></tr>
<?php endif; ?>
</tbody></table><?php echo e($pengajuan->links()); ?>

</div></div>
<?php if($pengajuan->total() > 0): ?>
<div class="card border-danger"><div class="card-body"><h2 class="h5 text-danger">Hapus seluruh pengajuan</h2><p>Tindakan ini menghapus seluruh data pengajuan dan berkas terkait. Ketik <strong>HAPUS SEMUA</strong> untuk melanjutkan.</p>
<form method="POST" action="<?php echo e(route('admin.berkas.destroyAll')); ?>" onsubmit="return confirm('Hapus seluruh pengajuan dan berkas?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><input class="form-control mb-2" name="confirmation" autocomplete="off" required><button class="btn btn-danger">Hapus semua</button></form>
</div></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-fuspi-laravel10\resources\views/admin/pengajuan/index.blade.php ENDPATH**/ ?>