<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\KaryaTulisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\VerifikasiJudulController;
use App\Http\Controllers\User\ProposalController;
use App\Http\Controllers\Admin\VerifProposalController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\User\FinalKaryaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\TahapanController;
use App\Http\Controllers\User\TeamController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\TahapanAppController;
use App\Http\Controllers\PengumumanController;


Route::get('/storage-link', function(){
   $targetFolder = base_path().'/storage/app/public';
   $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
   if(symlink( $targetFolder, $linkFolder )){
        echo "OK.";
    } else {
        echo "Gagal.";
    }
});

Route::view('/timeline', 'timeline');
Route::view('/detail-pengumuman', 'detail_pengumuman');
Route::get('/pengumuman/{id}', [LandingController::class, 'detail'])
    ->name('pengumuman.detail');

Route::get('/link', function () {
   $target = '/home/smtd7629/public_html/storage/app/public';
   $shortcut = '/home/smtd7629/public_html/public/storage';
   symlink($target, $shortcut);
});

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Redirect setelah login berdasarkan role
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/* Halaman Tahapan */
Route::get('/tahapanapp', [TahapanAppController::class, 'index'])
    ->name('tahapanapp');

/* Klik Card Tahapan */
Route::get('/tahapanapp/registrasi', [TahapanAppController::class, 'registrasi'])
    ->name('tahapanapp.registrasi');

Route::get('/tahapanapp/pengajuan-judul', [TahapanAppController::class, 'judul'])
    ->name('tahapanapp.judul');

Route::get('/tahapanapp/upload_proposal', [TahapanAppController::class, 'proposal'])
    ->name('tahapanapp.proposal');

Route::get('/tahapanapp/tahapan_finalisasi', [TahapanAppController::class, 'finalisasi'])
    ->name('tahapanapp.finalisasi');

// Halaman khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/admin/user', UserController::class);
    Route::resource('/admin/verifikasi', VerifikasiJudulController::class);


      Route::prefix('admin/pengumuman')->name('admin.pengumuman.')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('index');           // List semua pengumuman
        Route::get('/create', [PengumumanController::class, 'create'])->name('create');   // Form tambah
        Route::post('/', [PengumumanController::class, 'store'])->name('store');          // Simpan baru
        Route::get('/{id}/edit', [PengumumanController::class, 'edit'])->name('edit');    // Form edit
        Route::put('/{id}', [PengumumanController::class, 'update'])->name('update');     // Update
        Route::delete('/{id}', [PengumumanController::class, 'destroy'])->name('destroy');// Hapus
        Route::get('/{id}', [PengumumanController::class, 'show'])->name('show');        // Detail pengumuman
    });
    // Proposal
    Route::get('/admin/proposal', [VerifProposalController::class, 'index'])->name('admin.proposal.index');
    Route::put('/admin/proposal/verifikasi/{proposal}', [VerifProposalController::class, 'verifikasi'])->name('admin.proposal.verifikasi');
    Route::delete('/admin/proposal/{id}', [VerifProposalController::class, 'destroy'])->name('admin.proposal.destroy');
    Route::get('/admin/proposal/{proposal}/edit', [VerifProposalController::class, 'edit'])->name('admin.proposal.edit');
    Route::put('/admin/proposal/{proposal}', [VerifProposalController::class, 'update'])->name('admin.proposal.update');

    // Final Karya
    Route::resource('/admin/final-karya', App\Http\Controllers\Admin\VerifFinalController::class)
        ->only(['index', 'update'])
        ->names('admin.final');

    // Anggota & Tahapan
    Route::resource('/admin/anggota', AnggotaController::class)->names('admin.anggota');
    Route::resource('/admin/tahapan', TahapanController::class);

    //rekap
    Route::get('/admin/rekap', [RekapController::class, 'index'])->name('admin.rekap.index');
    Route::get('/rekap/export/{id}', [RekapController::class, 'export'])->name('rekap.export');
    Route::get('/rekap/export-all', [RekapController::class, 'exportAll'])->name('rekap.exportAll');

     Route::get('/admin/profile', [ProfileController::class, 'index'])
        ->name('admin.profile.index');

    Route::put('/admin/profile', [ProfileController::class, 'update'])
        ->name('admin.profile.update');

    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])
        ->name('admin.profile.destroy');
});


// Halaman khusus User
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::resource('/user/karya', KaryaTulisController::class);

    Route::get('/user/proposal', [ProposalController::class, 'index'])->name('proposal.index');
    Route::post('/user/proposal', [ProposalController::class, 'store'])->name('proposal.store');
    Route::get('/user/proposal/data', [ProposalController::class, 'getData'])->name('proposal.data');
    Route::delete('proposal/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');

    Route::resource('/user/final-karya', FinalKaryaController::class)
        ->only(['index', 'store', 'update'])
        ->names('finalkarya');
    Route::delete('finalkarya/{id}', [FinalKaryaController::class, 'destroy'])->name('finalkarya.destroy');

    Route::resource('/user/anggota', TeamController::class);

    Route::get('/user/profile', [ProfileController::class, 'index'])
        ->name('user.profile.index');

    Route::put('/user/profile', [ProfileController::class, 'update'])
        ->name('user.profile.update');

    Route::delete('/user/profile', [ProfileController::class, 'destroy'])
        ->name('user.profile.destroy');

});



require __DIR__ . '/auth.php';
