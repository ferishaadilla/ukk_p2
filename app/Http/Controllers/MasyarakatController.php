<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index(Request $request){
        $masyarakat = Masyarakat::all()->sortBy('nama');
        return view('Admin.masyarakat.index', compact('masyarakat'));
    }
}
