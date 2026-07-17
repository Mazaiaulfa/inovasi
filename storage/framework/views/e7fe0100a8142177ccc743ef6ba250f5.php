<?php $__env->startSection('title','Detail Peserta'); ?>

<?php $__env->startPush('style'); ?>
<style>
.card{
    border:none;
    border-radius:14px;
    box-shadow:0 4px 20px rgba(0,0,0,.06);
}

.card-header{
    background:#fff;
    border-bottom:1px solid #eef2f7;
}

.card-header h4{
    margin:0;
    font-size:18px;
    font-weight:700;
}

.info-table{
    width:100%;
}

.info-table td{
    padding:10px 4px;
    vertical-align:top;
}

.info-table td:first-child{
    width:180px;
    color:#64748b;
    font-weight:600;
}

.section-title{
    font-size:22px;
    font-weight:700;
    color:#1e293b;
}

.badge-status{
    padding:8px 18px;
    border-radius:30px;
    font-weight:600;
}

.badge-success{
    background:#22c55e;
    color:#fff;
}

.badge-warning{
    background:#f59e0b;
    color:#fff;
}

.badge-danger{
    background:#ef4444;
    color:#fff;
}

.member-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 0;
    border-bottom:1px solid #edf2f7;
}

.member-item:last-child{
    border-bottom:none;
}

.role-badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.role-ketua{
    background:#2563eb;
    color:#fff;
}

.role-fasilitator{
    background:#10b981;
    color:#fff;
}

.role-sekretaris{
    background:#f59e0b;
    color:#fff;
}

.role-anggota{
    background:#94a3b8;
    color:#fff;
}

.file-box{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:16px;
    border:1px solid #e5e7eb;
    border-radius:10px;
    margin-bottom:15px;
}

.file-box i{
    font-size:24px;
    color:#dc2626;
}

.file-title{
    font-weight:600;
}

.file-sub{
    color:#64748b;
    font-size:13px;
}

.btn-view{
    border-radius:8px;
}

.back-btn{
    border-radius:8px;
}

.start-btn{
    border-radius:8px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

<div class="main-content">

<section class="section">

<div class="section-header">
<h1>Detail Peserta</h1>
</div>

<div class="section-body">

<div class="row">

<div class="col-lg-12">

<?php
    $karya = $peserta->karyaTulis->first();
?>





<div class="card mb-4">

    <div class="card-header">
        <h4>Informasi Tim</h4>
    </div>

    <div class="card-body">

        <table class="info-table">

            <tr>
                <td>Nama Tim GKM</td>
                <td>: <?php echo e($peserta->name); ?></td>
            </tr>

            <tr>
                <td>Judul Inovasi</td>
                <td>: <?php echo e($karya->judul ?? '-'); ?></td>
            </tr>

            <tr>
                <td>Unit Kerja</td>
                <td>: <?php echo e($peserta->unit_kerja ?? '-'); ?></td>
            </tr>

            <tr>
                <td>Direktorat</td>
                <td>: <?php echo e($peserta->direktorat ?? '-'); ?></td>
            </tr>

            <tr>
                <td>Kompartemen</td>
                <td>: <?php echo e($peserta->kompartemen ?? '-'); ?></td>
            </tr>

        </table>

    </div>

</div>





<div class="card mb-4">

    <div class="card-header">
        <h4>Susunan Tim</h4>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped">

                <thead>

                    <tr>
                        <th width="60">No</th>
                        <th>Nama</th>
                        <th width="140">Badge</th>
                        <th width="180">Jabatan</th>
                    </tr>

                </thead>

                <tbody>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $peserta->anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($loop->iteration); ?></td>

                        <td><?php echo e($anggota->nama); ?></td>

                        <td><?php echo e($anggota->badge); ?></td>

                        <td>

                            <span class="badge badge-primary">

                                <?php echo e(ucfirst($anggota->jabatan)); ?>


                            </span>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="4" class="text-center">

                            Tidak ada anggota.

                        </td>

                    </tr>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>





<div class="card mb-4">

    <div class="card-header">

        <h4>Dokumen Final</h4>

    </div>

    <div class="card-body">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($peserta->finalKarya): ?>

            <div class="file-box">

                <div>

                    <div class="file-title">

                        Makalah Final

                    </div>

                    <div class="file-sub">

                        File final yang akan dinilai juri.

                    </div>

                </div>

               <a href="<?php echo e(asset($peserta->finalKarya->file_path)); ?>"
   target="_blank"
   class="btn btn-primary">
    <i class="bi bi-file-earmark-pdf"></i>
Lihat Makalah
</a>
            </div>

        <?php else: ?>

            <div class="alert alert-warning mb-0">

                Makalah final belum tersedia.

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>

</div>

<div class="d-flex justify-content-between mb-5">

    <a href="<?php echo e(route('juri.peserta')); ?>"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

    <a href="<?php echo e(route('juri.nilai.form',$peserta->id)); ?>"
       class="btn btn-primary">

        <i class="fas fa-clipboard-check"></i>

        Mulai Penilaian

    </a>

</div>

</div>

</div>

</div>

</div>


</section>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/juri/peserta/detail.blade.php ENDPATH**/ ?>