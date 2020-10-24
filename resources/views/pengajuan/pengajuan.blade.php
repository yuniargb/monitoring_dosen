@extends('layout')
@section('title', 'Data Pengajuan')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar {{ $title }}</div>
                    <div class="card-tools">
                        <a href="/pengajuan/form/" class="btn btn-primary btn-round btn-sm">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah {{ $title }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table basic-datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIDN</th>
                                            <th>Nama</th>
                                            <th>Fakultas</th>
                                            <th>Prodi</th>
                                            <th>Foto 1</th>
                                            <th>Foto 2</th>
                                            <th>Foto 3</th>
                                            <th>Foto 4</th>
                                            <th>Status</th>
                                            <th>Umur Hari</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->nidn }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->nama_fakultas }}</td>
                                            <td>{{ $sw->nama_prodi }}</td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-image="/images/{{ $sw->foto_1 }}" data-toggle="modal"
                                                    data-target="#exampleModal">Tampil</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-image="/images/{{ $sw->foto_2 }}" data-toggle="modal"
                                                    data-target="#exampleModal">Tampil</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-image="/images/{{ $sw->foto_3 }}" data-toggle="modal"
                                                    data-target="#exampleModal">Tampil</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-image="/images/{{ $sw->foto_4 }}" data-toggle="modal"
                                                    data-target="#exampleModal">Tampil</button>
                                            </td>
                                            <td>{!! $sw->status_text !!}</td>
                                            <td><p class="text-{{ $sw->umur <= 10 ? 'success' : ($sw->umur <= 20 ? 'warning' : 'danger') }}">{{ $sw->umur }} Hari</p></td>
                                            
                                            <td>
                                                @if(auth()->user()->role == 1 || auth()->user()->role == 4)
                                                    <div class="mx-3">
                                                         <a href="/pengajuan/form/{{ Crypt::encrypt($sw->id_pengajuan) }}" class="btn btn-primary btn-round btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @if( $sw->status != 2)
                                                        <form action="/api/pengajuan/delete/{{ Crypt::encrypt($sw->id_pengajuan) }}"
                                                            method="post" class="d-inline btn-del ">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                                    <div class="mx-3">
                                                        <a href="/pengajuan/form/konfirmasi/{{ Crypt::encrypt($sw->id_pengajuan) }}" class="btn btn-success btn-round btn-sm">
                                                            <i class="fas fa-check-circle"></i>
                                                        </a>
                                                        <a href="/pengajuan/form/tolak/{{ Crypt::encrypt($sw->id_pengajuan) }}" class="btn btn-warning btn-round btn-sm">
                                                            <i class="fas fa-times-circle"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
