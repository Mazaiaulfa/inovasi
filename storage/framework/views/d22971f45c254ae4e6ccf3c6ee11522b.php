<?php $__env->startSection('title', 'Daftar Peserta'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.css')); ?>">

<style>
.card{
    border:none;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,.06);
}

/* ===========================
   TABLE
=========================== */

.table-modern{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
}

.table-modern thead th{
    background:#f8fafc;
    color:#64748b;
    font-size:14px;
    font-weight:700;
    padding:12px 16px;
    border-bottom:1px solid #e5e7eb;
    border-right:1px solid #edf2f7;
    vertical-align:middle;
    white-space:nowrap;
}

.table-modern tbody td{
    padding:12px 16px;
    border-bottom:1px solid #edf2f7;
    border-right:1px solid #edf2f7;
    vertical-align:middle;
    font-size:14px;
}

.table-modern tbody tr{
    transition:.2s;
}

.table-modern tbody tr:hover{
    background:#f8fbff;
}

.table-modern th:first-child,
.table-modern td:first-child{
    width:60px;
    text-align:center;
}

.table-modern td:last-child,
.table-modern th:last-child{
    text-align:center;
}

/* ===========================
   STATUS
=========================== */

.badge-status{
    display:inline-block;
    padding:6px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}

.status-success{
    background:#dcfce7;
    color:#15803d;
}

.status-warning{
    background:#fef3c7;
    color:#b45309;
}

.status-secondary{
    background:#e2e8f0;
    color:#475569;
}

.nilai-text{
    color:#2563eb;
    font-weight:700;
}

.not-rated{
    color:#f59e0b;
    font-weight:600;
}

/* ===========================
   TOP TOOLBAR
=========================== */

.top-toolbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.progress-card{
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:10px 16px;
    font-size:14px;
}

/* ===========================
   ACTION BUTTON
=========================== */

.action-group{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
}

.action-btn,
.btn-locked{
    width:38px;
    height:38px;
    border-radius:10px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:.2s ease;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.action-btn i,
.btn-locked i{
    font-size:16px;
}

.action-btn:hover{
    transform:translateY(-2px);
    color:#fff;
    box-shadow:0 8px 18px rgba(0,0,0,.15);
}

.btn-detail{
    background:#3b82f6;
    color:#fff;
}

.btn-detail:hover{
    background:#2563eb;
}

.btn-view{
    background:#22c55e;
    color:#fff;
}

.btn-view:hover{
    background:#16a34a;
}

.btn-edit{
    background:#f59e0b;
    color:#fff;
}

.btn-edit:hover{
    background:#d97706;
}

.btn-locked{
    background:#64748b;
    color:#fff;
    cursor:not-allowed;
}

/* ===========================
   BUTTON SUBMIT
=========================== */

.btn-primary{
    border-radius:8px;
    padding:9px 18px;
    font-weight:600;
}

.btn-primary i{
    margin-right:5px;
}

/* ===========================
   ALERT
=========================== */

.alert{
    border:none;
    border-radius:10px;
}

/* ===========================
   RESPONSIVE
=========================== */

@media (max-width:768px){

    .table-modern thead th,
    .table-modern tbody td{
        padding:10px;
        font-size:13px;
    }

    .action-group{
        gap:6px;
    }

    .action-btn,
    .btn-locked{
        width:34px;
        height:34px;
    }

    .action-btn i,
    .btn-locked i{
        font-size:14px;
    }

}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Daftar Peserta</h1>
        </div>
        <div class="section-body">
    <div class="alert alert-info mb-4" style="border-radius:10px;">
    <i class="fas fa-info-circle me-2"></i>
    Silakan lakukan penilaian untuk seluruh peserta yang ditugaskan.
    Setelah semua penilaian selesai, klik tombol
    <b>Submit</b> untuk menyimpan dan mengirim hasil penilaian secara final.
    Penilaian yang telah disubmit tidak dapat diedit kembali.
</div>
    <div class="card">
    <div class="card-body">
        <?php
            $belumDinilai = $peserta->where('nilai', null)->count();
            $totalPeserta = $peserta->count();
            $sudahDinilai = $totalPeserta - $belumDinilai;
            $sudahSubmitSemua = $peserta->every(function ($item) {
        return $item->status == 'submitted';
    });
        ?>


        <div class="top-toolbar">



        </div>

        <div class="table-responsive">

            <table class="table-modern">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Departemen</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $peserta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($key + 1); ?></td>

                        <td>
                            <strong><?php echo e($item->name); ?></strong>
                        </td>

                        <td>
                            <?php echo e($item->email); ?>

                        </td>

                        <td>
                            <?php echo e($item->unit_kerja); ?>

                        </td>

                        <td>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->nilai): ?>

                                <span class="nilai-text">
                                    <?php echo e(number_format($item->nilai,0)); ?>

                                </span>

                            <?php else: ?>

                                <span class="not-rated">
                                    Belum Dinilai
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </td>

                        <td>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->status == 'submitted'): ?>

                                <span class="">
                                    Submitted
                                </span>

                            <?php elseif($item->status == 'draft'): ?>

                                <span class="">
                                    Draft
                                </span>

                            <?php else: ?>

                                <span class="badge-status status-secondary">
                                    -
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </td>

                       <td>

<div class="action-group">

    
    <a href="<?php echo e(route('juri.peserta.detail',$item->id)); ?>"
       class="action-btn btn-detail"
       data-toggle="tooltip"
       title="Lihat Detail">

        <i class="bi bi-eye"></i>

    </a>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$sudahSubmitSemua): ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($item->nilai)): ?>

        
        <a href="<?php echo e(route('juri.nilai.form',$item->id)); ?>"
           class="action-btn btn-view"
           data-toggle="tooltip"
           title="Mulai Penilaian">

            <i class="bi bi-clipboard-check"></i>

        </a>

    <?php else: ?>

        
        <a href="<?php echo e(route('juri.nilai.form',$item->id)); ?>"
           class="action-btn btn-edit"
           data-toggle="tooltip"
           title="Edit Penilaian">

            <i class="bi bi-pencil-square"></i>

        </a>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php else: ?>

    
    <a href="javascript:void(0)"
       class="btn-locked locked-action"
       data-toggle="tooltip"
       title="Penilaian Terkunci">

        <i class="bi bi-lock-fill"></i>

    </a>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>

</td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td colspan="7" class="text-center py-5">
                            Belum ada peserta yang di-assign
                        </td>
                    </tr>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="text-end mt-4">

            <form action="<?php echo e(route('juri.submit.semua')); ?>"
                  method="POST">

                <?php echo csrf_field(); ?>

                <button
                    type="submit"
                    class="btn btn-primary"
                    <?php echo e($belumDinilai > 0 ? 'disabled' : ''); ?>

                    onclick="return confirm('Submit semua penilaian?')">

                    <i class="fas fa-paper-plane"></i>
                    Submit

                </button>

            </form>

        </div>

    </div>
</div>

        </div>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.locked-action').forEach(button => {

    button.addEventListener('click', function () {

        Swal.fire({
            icon: 'info',
            title: 'Penilaian Terkunci',
            text: 'Semua penilaian telah disubmit permanen dan tidak dapat diubah lagi.',
            confirmButtonColor: '#4f46e5',
            confirmButtonText: 'Mengerti'
        });

    });

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/juri/peserta/index.blade.php ENDPATH**/ ?>