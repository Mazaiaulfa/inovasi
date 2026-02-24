<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center" style=" margin-bottom: 20px;">
            <a href="<?php echo e(url('/dashboard')); ?>">
                <img src="<?php echo e(asset('img/logo.jpg')); ?>" alt="Logo" style="height: 58px; width: auto;">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm" style=" margin-bottom: 20px;">
            <a href="<?php echo e(url('/dashboard')); ?>">
                <img src="<?php echo e(asset('img/iconLogo.png')); ?>" alt="Logo" style="height: 40px;">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            
            <?php if(Auth::user()->role === 'admin'): ?>
            <li class="<?php echo e(Request::is('admin') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(url('/admin')); ?>">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
            </li>

            
            <li
                class="nav-item dropdown <?php echo e(Request::is('admin/verifikasi*') || Request::is('admin/proposal*') || Request::is('admin/final-karya*') ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-clipboard-check"></i> <span>Verifikasi</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e(Request::is('admin/verifikasi') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(url('/admin/verifikasi/')); ?>">
                            <i class="fas fa-file-alt"></i> Judul Makalah
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/proposal') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(url('/admin/proposal/')); ?>">
                            <i class="fas fa-file-upload"></i> Makalah
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/final-karya') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('admin.final.index')); ?>">
                            <i class="fas fa-check-double"></i> Final
                        </a>
                    </li>
                </ul>
            </li>



            <li
                class="nav-item dropdown <?php echo e(Request::is('admin/user*') || Request::is('admin/rekap*') ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fa-solid fa-chart-simple"></i> <span>Rekap</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e(Request::is('admin/rekap') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(url('/admin/rekap')); ?>">
                            <i class="fas fa-clipboard-list"></i> Data Inovasi
                        </a>
                    </li>
                </ul>
            </li>

            
            <li
                class="nav-item dropdown <?php echo e(Request::is('admin/user*') || Request::is('admin/anggota*') ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users-cog"></i> <span>Kelola Account</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e(Request::is('admin/user') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(url('/admin/user/')); ?>">
                            <i class="fas fa-user"></i> User
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/anggota') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(url('/admin/anggota')); ?>">
                            <i class="fas fa-user-friends"></i> Anggota Team
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/tahapan') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(url('/admin/tahapan')); ?>">
                            <i class="fas fa-layer-group"></i> Tahapan
                        </a>
                    </li>
                </ul>
            </li>

            
            <li class="<?php echo e(Request::is('admin/pengumuman*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('admin.pengumuman.index')); ?>">
                    <i class="fas fa-bullhorn"></i> <span>Kelola Pengumuman</span>
                </a>
            </li>

            <li class="<?php echo e(Request::is('admin/profile*') ? 'active' : ''); ?>">
    <a class="nav-link" href="<?php echo e(route('admin.profile.index')); ?>">
        <i class="fas fa-user-circle"></i>
        <span>Profile</span>
    </a>
</li>


            
            <?php elseif(Auth::user()->role === 'user'): ?>
            <li class="<?php echo e(Request::is('user') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(url('/user')); ?>">
                    <i class="fas fa-tachometer-alt"></i> <span>User Dashboard</span>
                </a>
            </li>

            
            <li
                class="nav-item dropdown <?php echo e(Request::is('user/karya*') || Request::is('user/proposal*') || Request::is('user/final-karya*') ? 'active' : ''); ?>">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-file-signature"></i> <span>Pengajuan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo e(Request::is('user/karya*') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('karya.index')); ?>">
                            <i class="fas fa-lightbulb"></i> Judul
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('user/proposal*') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('proposal.index')); ?>">
                            <i class="fas fa-file-alt"></i> Makalah
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('user/final-karya*') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(route('finalkarya.index')); ?>">
                            <i class="fas fa-book"></i> Submit Final
                        </a>
                    </li>
                </ul>
            </li>

                        <?php if(Auth::user()->jenis_peserta == 'GKM'): ?>
            <li class="<?php echo e(Request::is('user/anggota*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('anggota.index')); ?>">
                    <i class="fas fa-users"></i> <span>Tambah Anggota Team</span>
                </a>
            </li>
            <?php endif; ?>

                    <li class="<?php echo e(Request::is('user/profile*') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('user.profile.index')); ?>">
                <i class="fas fa-user-circle"></i>
                <span>Profile</span>
            </a>
        </li>
            <?php endif; ?>

            <li class="<?php echo e(Request::is('logout') ? 'active' : ''); ?>">
                <a href="#" class="nav-link text-danger" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </a>
            </li>

        </ul>
    </aside>
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\inovasirev\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>