<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Petugas;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PengaduanController extends Controller
{
    public function index(Request $request){
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->get();
        $masyarakat = Masyarakat::all();
        $petugas = Petugas::all();
        return view('pengaduan.index', compact('pengaduan', 'masyarakat', 'petugas'));
    }

    public function verify(Request $request, $id){
        $pengaduan = Pengaduan::find($id);
        $pengaduan->update($request->all());
        $pengaduan->update();
        return redirect()->route('pengaduan.index');
    }

    public function formTanggapan($id){
        return view('Pengaduan.form-tanggapan',[
            'pengaduan' => Pengaduan::find($id)
        ]);
    }

    public function tanggapan(Request $request, $id){
        $pengaduan = Pengaduan::find($id);
        $pengaduan->update($request->all());
        $pengaduan->update();
        return redirect()->route('pengaduan.index');
    }

    public function detail($id){
        $pengaduan = Pengaduan::find($id);
        return view('pengaduan.detail', compact('pengaduan'));
    }
}
