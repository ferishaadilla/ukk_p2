@extends('Layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">Isi Tanggapan</h5>
            <p class="card-title">{{ $pengaduan->created_at->format('l, d F Y') }}</p>
        </div>
        <form action="{{route('pengaduan.simpan-tanggapan', $pengaduan->id)}}" method="POST" id="myForm" >
            @csrf
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

            <div class="mb-3">
                <label class="form-label fw-bold">Tanggapan :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="tanggapan"></textarea>
                @error('tanggapan')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="btn-footer d-flex justify-content-end">
                <a href="{{route('pengaduan.index')}}" class="btn btn-danger me-1 cancel-button">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection