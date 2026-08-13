<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita', [PublicController::class, 'berita'])->name('berita.index');
Route::get('/berita/{post:slug}', [PublicController::class, 'showBerita'])->name('berita.show');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/halaman/{slug}', [PublicController::class, 'page'])->name('page');
Route::get('/jurusan', [PublicController::class, 'jurusan'])->name('jurusan');
Route::get('/gtk', [PublicController::class, 'gtk'])->name('gtk');
Route::get('/search', [PublicController::class, 'search'])->name('search');

Route::get('/pendaftaran', [\App\Http\Controllers\FrontController::class, 'pendaftaran'])->name('ppdb.pendaftaran');
Route::post('/pendaftaran', [\App\Http\Controllers\FrontController::class, 'storePendaftaran'])->name('ppdb.store');
Route::get('/pembayaran-ppdb/{id}', [\App\Http\Controllers\FrontController::class, 'pembayaran'])->name('ppdb.pembayaran');
Route::post('/pembayaran-ppdb/{id}', [\App\Http\Controllers\FrontController::class, 'processPembayaran'])->name('ppdb.process_pembayaran');
Route::get('/pendaftaran-berhasil', [\App\Http\Controllers\FrontController::class, 'berhasil'])->name('ppdb.berhasil');
Route::get('/tes-ppdb/{id}', [\App\Http\Controllers\FrontController::class, 'showTest'])->name('ppdb.test');
Route::post('/tes-ppdb/{id}', [\App\Http\Controllers\FrontController::class, 'submitTest'])->name('ppdb.test.submit');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('teachers', \App\Http\Controllers\Admin\TeacherController::class);
    Route::resource('majors', \App\Http\Controllers\Admin\MajorController::class);
    
    // Master Data Akademik
    Route::resource('academic-years', \App\Http\Controllers\Admin\AcademicYearController::class);

    // Route Users
    Route::post('/users/{user}/reset-password', [\App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('users.reset_password');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::resource('announcements', \App\Http\Controllers\Admin\AnnouncementController::class);
    
    Route::resource('test-questions', \App\Http\Controllers\Admin\TestQuestionController::class);
    
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    
    Route::get('/live-chat', function () {
        return view('admin.live-chat');
    })->name('live-chat');
});

// TU Routes (Admin also has access logically, but for now we separate prefix)
Route::middleware(['auth', 'verified', 'role:tu|admin'])->prefix('tu')->name('tu.')->group(function () {
    Route::get('/dashboard', function () {
        return view('tu.dashboard');
    })->name('dashboard');
    
    // Akademik & Kesiswaan
    Route::get('/ppdb', [\App\Http\Controllers\Tu\PpdbController::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/export/csv', [\App\Http\Controllers\Tu\PpdbController::class, 'exportCsv'])->name('ppdb.export.csv');
    Route::get('/ppdb/export/pdf', [\App\Http\Controllers\Tu\PpdbController::class, 'exportPdf'])->name('ppdb.export.pdf');
    Route::post('/ppdb/{id}/accept', [\App\Http\Controllers\Tu\PpdbController::class, 'accept'])->name('ppdb.accept');
    Route::post('/ppdb/{id}/reject', [\App\Http\Controllers\Tu\PpdbController::class, 'reject'])->name('ppdb.reject');
    Route::delete('/ppdb/{id}', [\App\Http\Controllers\Tu\PpdbController::class, 'destroy'])->name('ppdb.destroy');

    Route::get('/students', [\App\Http\Controllers\Tu\StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [\App\Http\Controllers\Tu\StudentController::class, 'show'])->name('students.show');

    Route::get('/parents', [\App\Http\Controllers\Tu\ParentController::class, 'index'])->name('parents.index');
    Route::get('/parents/{id}', [\App\Http\Controllers\Tu\ParentController::class, 'show'])->name('parents.show');

    Route::resource('classrooms', \App\Http\Controllers\Tu\ClassroomController::class);
    
    // Kurikulum & Jadwal
    Route::resource('subjects', \App\Http\Controllers\Tu\SubjectController::class);

    Route::resource('schedules', \App\Http\Controllers\Tu\ScheduleController::class);
    
    // Keuangan
    Route::resource('finance', \App\Http\Controllers\Tu\FinanceController::class);
    
    Route::get('/live-chat', function () {
        return view('admin.live-chat');
    })->name('live-chat');
});

// Guru Routes
Route::middleware(['auth', 'verified', 'role:walikelas|admin'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', function () {
        return view('guru.dashboard');
    })->name('dashboard');
    
    Route::get('/schedules', [\App\Http\Controllers\Guru\ScheduleController::class, 'index'])->name('schedules.index');
    
    Route::get('/absensi', [\App\Http\Controllers\Guru\AttendanceController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [\App\Http\Controllers\Guru\AttendanceController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [\App\Http\Controllers\Guru\AttendanceController::class, 'store'])->name('absensi.store');
    
    Route::get('/nilai', [\App\Http\Controllers\Guru\GradeController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/create', [\App\Http\Controllers\Guru\GradeController::class, 'create'])->name('nilai.create');
    Route::post('/nilai', [\App\Http\Controllers\Guru\GradeController::class, 'store'])->name('nilai.store');
    Route::get('/rapor', [\App\Http\Controllers\Guru\RaporController::class, 'index'])->name('rapor.index');
    Route::get('/rapor/{id}/print', [\App\Http\Controllers\Guru\RaporController::class, 'print'])->name('rapor.print');
});

// Wali Murid Routes
Route::middleware(['auth', 'verified', 'role:walimurid'])->prefix('wali')->name('wali.')->group(function () {
    Route::get('/dashboard', function () {
        return view('wali.dashboard');
    })->name('dashboard');
    
    Route::get('/announcements', [\App\Http\Controllers\Wali\AnnouncementController::class, 'index'])->name('announcements.index');
    
    Route::get('/schedules', [\App\Http\Controllers\Wali\ScheduleController::class, 'index'])->name('schedules.index');
    
    Route::get('/tagihan', [\App\Http\Controllers\Wali\TagihanController::class, 'index'])->name('tagihan.index');
    Route::post('/tagihan/{invoice}/pay', [\App\Http\Controllers\Wali\TagihanController::class, 'pay'])->name('tagihan.pay');
    
    Route::get('/absensi-anak', [\App\Http\Controllers\Wali\AttendanceController::class, 'index'])->name('absensi.index');
    
    Route::get('/rapor-anak', [\App\Http\Controllers\Wali\RaporController::class, 'index'])->name('rapor.index');
    Route::get('/rapor-anak/{id}/print', [\App\Http\Controllers\Wali\RaporController::class, 'print'])->name('rapor.print');
});

// Redirect default Breeze dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasRole('admin')) return redirect()->route('admin.dashboard');
    if ($user->hasRole('tu')) return redirect()->route('tu.dashboard');
    if ($user->hasRole('walikelas')) return redirect()->route('guru.dashboard');
    if ($user->hasRole('walimurid')) return redirect()->route('wali.dashboard');
    
    return abort(403);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
