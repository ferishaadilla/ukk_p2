<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserMasyarakatController extends Controller
{
    // Login
    public function formLogin(){
        return view('Auth.masyarakat.login');
    }

    public function login(Request $request ){
        $credentials = $request->only('username', 'password');
        $masyarakat = Auth::guard('masyarakats')->attempt($credentials);

        if($masyarakat) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }else {
            return redirect('/login')->withErrors([
                'error' => 'Username atau password salah.'
            ]);
        }
    }

    // Log Out
    public function logout(Request $request){
        Auth::guard('masyarakats')->logout();
        return redirect('/');
    }

    // Register
    public function formRegister(){
        return view('Auth.masyarakat.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik'  => 'required|unique:masyarakats',
            'nama'  => 'required',
            'username'  => 'required',
            'telp'  => 'required|min:12',
            'password' => 'required',
        ]);

        $masyarakat = new Masyarakat;
        $masyarakat->nik = $request->nik;
        $masyarakat->nama = $request->nama;
        $masyarakat->username = $request->username;
        $masyarakat->telp = $request->telp;
        $masyarakat->password = Hash::make($request->password);
        $masyarakat->save();
        return redirect("/login");
    }

    public function formLaporan(){
        return view('Masyarakat.form-laporan');
    }

    public function lapor(Request $request){
        $request->validate([
            'nik_masyarakat'  => 'required',
            'judul_laporan'  => 'required',
            'isi_laporan'  => 'required',
            'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $pengaduan = new Pengaduan;
        $pengaduan->nik_masyarakat = $request->nik_masyarakat;
        $pengaduan->judul_laporan = $request->judul_laporan;
        $pengaduan->isi_laporan = $request->isi_laporan;
        $pengaduan->status = $request->status;

        if($request->hasFile('foto')){
            $request->file('foto')->move('foto/', $request->file('foto')->getClientOriginalName());
            $pengaduan->foto = $request->file('foto')->getClientOriginalName();
            $pengaduan->save();
        }

        $pengaduan->save();
        

        return redirect('/laporan-saya');
    }

    public function laporanSaya(Request $request){
        $pengaduan = Pengaduan::where('nik_masyarakat', Auth::guard('masyarakats')->user()->nik)->orderBy('created_at')->get();
        return view('Masyarakat.laporan-saya', compact('pengaduan'));
    }
}
