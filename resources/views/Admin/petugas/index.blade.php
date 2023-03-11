@extends('layouts.app')
@section('content')
<a href="{{route('admin.petugas.create')}}" class="btn btn-primary mb-3 ">
    Tambah +
</a>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Petugas</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Telp</th>
                        <th data-sortable="false">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($petugas as $row)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $row->nama }}
                        </td>
                        <td>
                            {{ $row->username }}
                        </td>
                        <td>
                            {{ $row->level }}
                        </td>
                        <td>
                            {{ $row->telp }}
                        </td>
                        <td>
                            <a href="{{route('admin.petugas.edit', $row->id)}}" class="btn btn-primary btn-sm"
                                title="Edit petugas">
                                <i class='bx bx-edit-alt'></i>
                            </a>
    
                            <form action="{{ route('admin.petugas.delete', $row->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-button" id="deleteButton"
                                    title="Delete petugas">
                                    <i class='bx bx-trash-alt'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection