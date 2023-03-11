@extends('Layouts.app')
@section('content')
<a href="{{route('pengaduan.index')}}" class="btn btn-primary mb-3">Kembali</a>
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">Detail Laporan</h5>
            <p class="card-title">{{ $pengaduan->created_at->format('l, d F Y') }}</p>
        </div>
        <div class="mb-3">
            <strong>Judul Laporan :</strong>
            <p>{{ $pengaduan->judul_laporan }}</p>
        </div>
        <div class="mb-3">
            <strong>Isi Laporan :</strong>
            <p>{{ $pengaduan->isi_laporan }}</p>
        </div>
        <div class="mb-3">
            <strong>Foto :</strong>
            <img src="/foto/{{$pengaduan->foto}}" class="img-thumbnail" style="width:200px" />
        </div>
        <div class="mb-1 d-flex">
            <strong class="me-1">Status :</strong>
            @if ($pengaduan->status=="0")
                <p class="text-danger">Pending</p>
            @elseif($pengaduan->status=="proses")
                <p class="text-warning">Proses</p>
            @else
                <p class="text-success">Selesai</p>
            @endif
        </div>
        @if ($pengaduan->status=="selesai")
            <div class="mb-3">
                <strong>Tanggapan :</strong>
                <p>{{ $pengaduan->tanggapan }}</p>
            </div>

            <div class="d-flex">
                <strong class="me-1">Petugas :</strong>
                <p>{{ $pengaduan->petugas->nama }}</p>
            </div>
        @endif
    </div>
</div>
@endsection