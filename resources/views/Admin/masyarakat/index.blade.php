@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Masyarakat</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Username</th>
                        <th>Telp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masyarakat as $row)
                    <tr>
                        <td>
                            {{ $row->nama }}
                        </td>
                        <td>
                            {{ $row->nik }}
                        </td>
                        <td>
                            {{ $row->username }}
                        </td>
                        <td>
                            {{ $row->telp }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection