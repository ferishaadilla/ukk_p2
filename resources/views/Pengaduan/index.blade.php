@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Pengaduan</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped " id="table">
                <thead>
                    <tr>
                        <th>Tgl Pengaduan</th>
                        <th>Judul Laporan</th>
                        <th>Nama Pelapor</th>
                        <th>Status</th>
                        <th>Petugas</th>
                        <th data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduan as $row)
                    <tr>
                        <td>
                            {{ $row->created_at->format('l, d F Y') }}
                            {{-- {{ $row->created_at}} --}}
                        </td>

                        <td>
                            {{ Str::limit($row->judul_laporan, 20, '...') }}
                        </td>
                        
                        <td>
                            {{ $row->masyarakat->nama }}
                        </td>

                        <td>
                            @if ($row->status=="0")
                                <p class="text-danger">Pending</p>
                            @elseif($row->status=="proses")
                                <p class="text-warning">Proses</p>
                            @else
                                <p class="text-success">Selesai</p>
                            @endif
                        </td>

                        <td>{{ $row->petugas->nama }}</td>

                        <td>
                            @if ($row->status == '0')
                            <form action="{{ route('pengaduan.verifikasi', $row->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <input type="hidden" class="form-control" id="status" name="status" autocomplete="off" value="proses"/>

                                <button type="submit" class="btn btn-success btn-sm delete-button" id="deleteButton"
                                    title="Verifikasi">
                                    <i class='bx bx-check'></i>
                                </button>
                            </form>
                            @endif

                            @if ($row->status == 'proses')
                            <a href="{{route('pengaduan.form-tanggapan', $row->id)}}" class="btn btn-primary btn-sm">
                                <i class='bx bx-comment'></i>
                            </a>
                            @endif

                            <a href="{{route('pengaduan.detail', $row->id)}}" class="btn btn-primary btn-sm"
                            title="Lihat Detail Laporan">
                            <i class='bx bx-detail'></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
