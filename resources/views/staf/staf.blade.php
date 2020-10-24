@extends('layout')
@section('title', 'Data Staf')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar {{ $title }}</div>
                    <div class="card-tools">
                        <a href="/admin/staf/form/" class="btn btn-primary btn-round btn-sm">
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
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Fakultas</th>
                                            <th>Nomor Telfon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->username }}</td>
                                            <td>{{ $sw->email }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->no_telp }}</td>
                                            <td>{{ $sw->nama_fakultas }}</td>
                                            <td>
                                                <div class="row">
                                                    <a href="/admin/staf/form/{{ Crypt::encrypt($sw->id) }}" class="btn btn-primary btn-round btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="/api/admin/staf/delete/{{ Crypt::encrypt($sw->id) }}"
                                                        method="post" class="d-inline btn-del">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"
                                                            data-toggle="tooltip" data-original-title="Hapus"><i
                                                                class="fa fa-times"></i></button>
                                                    </form>
                                                </div>
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
