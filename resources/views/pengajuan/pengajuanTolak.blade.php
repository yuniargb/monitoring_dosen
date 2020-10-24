@extends('layout')
@section('title', 'Data Pengajuan Ditolak')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar {{ $title }}</div>
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
                                            <th>Pesan</th>
                                            <th>Tanggal Tolak</th>
                                            <th>Umur</th>
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
                                            <td>Ditolak</td>
                                            <td>{{ $sw->pesan_revisi }}</td>
                                            <td>{{ date('d-m-Y', strtotime($sw->tanggal_tolak)) }}</td>
                                            <td><p class="text-{{ $sw->umur <= 10 ? 'success' : ($sw->umur <= 20 ? 'warning' : 'danger') }}">{{ $sw->umur }} Hari</p></td>
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
