<?php $__env->startSection('title', 'User Dashboard'); ?>

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

        <!-- Statistik Card -->
        <div class="row">
            <!-- Judul Diajukan -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Judul Diajukan</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($judulDiajukan); ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Draft Disetujui -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Draft Makalah Disetujui</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($draftDisetujui); ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Final Disetujui -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Final Disetujui</h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($finalDisetujui); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row">
            <!-- Karya Chart -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <?php echo $karyaChart->container(); ?>

                    </div>
                </div>
            </div>

            <!-- Final Chart -->
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php echo $karyaChart->script(); ?>

<?php echo $finalChart->script(); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/dashboard.blade.php ENDPATH**/ ?>