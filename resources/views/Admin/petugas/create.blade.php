@extends('layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Tambah Petugas</h5>
        <form action="{{route('admin.petugas.store')}}" method="POST" id="myForm">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" />
                @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Username</label>
                <input type="text" class="form-control" id="username" name="username" autocomplete="off"/>
                @error('username')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Level</label>
                <select id="defaultSelect" class="form-select" name="level">
                    <option selected>Pilih Level</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-company">Password</label>
                <input type="text" class="form-control" name="password"/>
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="basic-default-phone">No Telp</label>
                <input type="number" class="form-control phone-mask" name="telp"/>
                    @error('telp')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="btn-footer d-flex justify-content-end">
                <a href="{{route('admin.petugas.index')}}" class="btn btn-danger me-1 cancel-button">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
            </div> 
        </form>
    </div>
</div>
@endsection