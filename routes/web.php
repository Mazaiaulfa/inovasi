<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimelineController;
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
use App\Http\Controllers\JuriController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\Admin\AdminJuriController;
use App\Http\Controllers\Admin\KonvensiController;

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

    if (Auth::user()->role === 'juri') {
        return redirect()->route('juri.dashboard');
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
    Route::get('/', [PengumumanController::class, 'index'])->name('index');
    Route::get('/create', [PengumumanController::class, 'create'])->name('create');
    Route::post('/', [PengumumanController::class, 'store'])->name('store');

    Route::get('/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('edit');
    Route::put('/{pengumuman}', [PengumumanController::class, 'update'])->name('update');
    Route::delete('/{pengumuman}', [PengumumanController::class, 'destroy'])->name('destroy');
    Route::get('/{pengumuman}', [PengumumanController::class, 'show'])->name('show');
});


    Route::prefix('admin/timeline')->name('admin.timeline.')->group(function () {
    Route::get('/create', [TimelineController::class, 'create'])->name('create');
    Route::post('/', [TimelineController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [TimelineController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TimelineController::class, 'update'])->name('update');
    Route::delete('/{id}', [TimelineController::class, 'destroy'])->name('destroy');
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
    Route::get('/admin/history', [RekapController::class, 'history'])->name('admin.history.index');
    Route::get('/admin/history/{gugus}', [RekapController::class, 'show'])->name('admin.history.show');
     Route::get('/admin/profile', [ProfileController::class, 'index'])
        ->name('admin.profile.index');

    Route::put('/admin/profile', [ProfileController::class, 'update'])
        ->name('admin.profile.update');

    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])
        ->name('admin.profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('konvensi', [KonvensiController::class, 'index'])
        ->name('konvensi.index');

    // 🔥 FINALISASI
    Route::post('konvensi/publish', [KonvensiController::class, 'publish'])
        ->name('publish');

    // 🔥 DETAIL NILAI
    Route::get('konvensi/{id}', [KonvensiController::class, 'detail'])
        ->name('nilai.detail');

    // 🔥 EDIT NILAI
    Route::get('konvensi/{id}/edit', [KonvensiController::class, 'edit'])
        ->name('nilai.edit');

    Route::put('konvensi/{id}', [KonvensiController::class, 'update'])
        ->name('nilai.update');

    Route::resource('kriteria', KriteriaController::class);
});

Route::prefix('admin/juri')
    ->name('admin.juri.')
    ->middleware(['auth','role:admin'])
    ->group(function () {

    Route::get('/', [AdminJuriController::class, 'index'])->name('index');

    Route::get('/create', [AdminJuriController::class, 'create'])->name('create');
    Route::post('/store', [AdminJuriController::class, 'store'])->name('store');

    Route::get('/assign/{id}', [AdminJuriController::class, 'formAssign'])->name('assign.form');
    Route::post('/assign', [AdminJuriController::class, 'assign'])->name('assign');

    Route::get('/peserta/{id}', [AdminJuriController::class, 'DaftarPeserta'])->name('peserta');
    Route::get('/edit/{id}', [AdminJuriController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AdminJuriController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [AdminJuriController::class, 'destroy'])->name('destroy');


});

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

Route::middleware(['auth', 'role:juri'])
    ->prefix('juri')
    ->name('juri.')
    ->group(function () {

    Route::get('/', function () {
        return view('juri.dashboard');
    })->name('dashboard');


    Route::post('/penilaian', [JuriController::class, 'nilai'])->name('nilai');
    Route::get('/peserta', [JuriController::class, 'peserta'])->name('peserta');
    Route::post('/peserta/submit/{id}', [JuriController::class, 'submit'])
        ->name('submit');
        Route::post('/submit-semua', [JuriController::class, 'submitSemua'])
    ->name('submit.semua');
    // Route::get('/nilai/{id}', [JuriController::class, 'penilaian'])->name('nilai');
    Route::get('/nilai/{id}', [NilaiController::class, 'create'])
    ->name('nilai.form'); // BUKAN juri.nilai.form
    Route::post('/nilai', [NilaiController::class, 'store'])
    ->name('nilai.store');



});



require __DIR__ . '/auth.php';
