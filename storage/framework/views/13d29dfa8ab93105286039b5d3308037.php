<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startPush('style'); ?>
<!-- CSS Libraries -->
<link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <!-- Statistik Singkat -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tim Terdaftar</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalUsers); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Judul Diajukan</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalKarya); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-file-upload"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Draft Makalah</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalProposal); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Finalisasi Makalah</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalFinalKarya); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row Chart 1: Judul & Proposal -->
        <div class="row mt-4">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <?php echo $judulChart->container(); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <?php echo $userTahapanChart->container(); ?>


                    </div>
                </div>
            </div>
        </div>

        <!-- Row Chart 2: Final & Distribusi -->
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <?php echo $proposalChart->container(); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <?php echo $finalChart->container(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php echo $judulChart->script(); ?>

<?php echo $proposalChart->script(); ?>

<?php echo $finalChart->script(); ?>

<?php echo $userTahapanChart->script(); ?>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>