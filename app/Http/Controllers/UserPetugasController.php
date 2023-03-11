<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPetugasController extends Controller
{
    // Login
    public function formLogin(){
        return view('Auth.petugas.login');
    }

    public function login(Request $request ){
        $credentials = $request->only('username', 'password');
        $petugas = Auth::guard('petugas')->attempt($credentials);

        if($petugas) {
            if (Auth::guard('petugas')->user()->level == 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/admin-dashboard');
            } else {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
        }else {
            return redirect('/admin/')->withErrors([
                'error' => 'Username atau password salah.'
            ]);
        }
        return back()->with('error', 'Login failed! Please try again');
    }

    // Log Out
    public function logout(Request $request){
        Auth::guard('petugas')->logout();
        return redirect('/admin/');
    }

    // Register Admin
    public function formRegister(){
        return view('Auth.petugas.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'username'  => 'required',
            'telp'  => 'required|min:12',
            'password' => 'required',
        ]);

        $admin = new Petugas;
        $admin->nama = $request->nama;
        $admin->username = $request->username;
        $admin->level = 'admin';
        $admin->telp = $request->telp;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect("/admin/");
    }

    public function adminDashboard(){
        $diterima = Pengaduan::where('status', '0')->count();
        $diproses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $admin = Petugas::where('level', 'admin')->count();
        $petugas = Petugas::where('level', 'petugas')->count();
        $masyarakat = Masyarakat::count();
        return view('Admin.dashboard', compact('diterima', 'diproses', 'selesai', 'petugas', 'admin', 'masyarakat'));
    }

    public function dashboard(){
        $diterima = Pengaduan::where('status', '0')->count();
        $diproses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        return view('Petugas.dashboard', compact('diterima', 'diproses', 'selesai'));
    }
}
