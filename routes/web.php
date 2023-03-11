<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\UserPetugasController;
use App\Http\Controllers\UserMasyarakatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



    // Forgot Password Form
    Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot.password.get')->middleware('guest');

    // Forgot Password 
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot.password.post')->middleware('guest');

    // Reset Password Form
    Route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('reset.password.get');

    // Reset Password
    Route::post('/reset-password/{token}', [AuthController::class, 'postResetPassword'])->name('reset.password.post');

// Masyarakat Routes
    // Auth
        // Login Form 
        Route::get('/login', [UserMasyarakatController::class, 'formLogin'])->name('form-login');

        // Login 
        Route::post('/login', [UserMasyarakatController::class, 'login'])->name('login')->middleware('guest');

        // Logout
        Route::get('/logout',[UserMasyarakatController::class,'logout'])->name('logout');

        // Register Form
        Route::get('/register', [UserMasyarakatController::class, 'formRegister'])->name('form-register')->middleware('guest');

        // Register
        Route::post('/register', [UserMasyarakatController::class, 'register'])->name('register')->middleware('guest');

    // Home page
    Route::get('/', function(){
        return view('landing-page');
    })->name('landing-page');

    Route::middleware(['masyarakat'])->group(function () {
        // Form Laporan
        Route::get('/form-laporan', [UserMasyarakatController::class, 'formLaporan'])->name('form-laporan')->middleware('masyarakat');
        
        // Lapor
        Route::post('/laporan-saya', [UserMasyarakatController::class, 'lapor'])->name('simpan-laporan')->middleware('masyarakat');
        
        // Feedback
        Route::get('/feedback', function () {
            return view('User Masyarakat.feedback');
        })->name('user.masyarakat.feedback')->middleware('masyarakat');
        
        // List pengaduan
        Route::get('/laporan-saya', [UserMasyarakatController::class, 'laporanSaya'])->name('laporan-saya')->middleware('masyarakat');
    });


// User Admin & Petugas
Route::prefix('admin')->group(function (){

    // Auth
        // Login Form 
        Route::get('/', [UserPetugasController::class, 'formLogin'])->name('admin.form-login');

        // Login 
        Route::post('/login', [UserPetugasController::class, 'login'])->name('admin.login')->middleware('guest');

        // Logout
        Route::get('/logout',[UserPetugasController::class,'logout'])->name('admin.logout');

        // Register Form
        Route::get('/register', [UserPetugasController::class, 'formRegister'])->name('admin.form-register')->middleware('guest');

        // Register
        Route::post('/registered', [UserPetugasController::class, 'register'])->name('admin.register')->middleware('guest');

    // User Admin
    Route::middleware(['admin'])->group(function () {
        // Dashboard
        Route::get('/admin-dashboard', [UserPetugasController::class, 'adminDashboard'])->name('admin.dashboard');

        // Data Masyarakat
            // Index 
            Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('admin.masyarakat.index');

        // Data Petugas
            // Index
            Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index');

            // Create
            Route::get('/petugas/create', [PetugasController::class, 'create'])->name('admin.petugas.create');

            // Store
            Route::post('/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store');

            // Edit
            Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('admin.petugas.edit');

            // Update
            Route::post('/petugas/{id}', [PetugasController::class, 'update'])->name('admin.petugas.update');

            // Delete
            Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('admin.petugas.delete');
    });
    
    // User Petugas
    Route::middleware(['petugas'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [UserPetugasController::class, 'dashboard'])->name('petugas.dashboard')->middleware('petugas');
    });

    Route::middleware(['petugas.admin'])->group(function () {
        // CRUD Pengaduan
            // Index 
            Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    
            // Diverifikasi
            Route::post('/pengaduan/{id}', [PengaduanController::class, 'verify'])->name('pengaduan.verifikasi');
    
            // Detail
            Route::get('/pengaduan/{id}/detail', [PengaduanController::class, 'detail'])->name('pengaduan.detail');

            // Form Tanggapan
            Route::get('/pengaduan/{id}/tanggapan', [PengaduanController::class, 'formTanggapan'])->name('pengaduan.form-tanggapan');
    
            // Tanggapan
            Route::post('/pengaduan/{id}', [PengaduanController::class, 'tanggapan'])->name('pengaduan.simpan-tanggapan');
    
            // PDF
            Route::get('/pengaduan/{id}/pdf', [PengaduanController::class, 'pdf'])->name('pengaduan.pdf')->middleware('admin');
    });
});

