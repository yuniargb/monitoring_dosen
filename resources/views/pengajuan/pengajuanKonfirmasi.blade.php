@extends('layout')
@section('title', 'Data Pengajuan DiKonfirmasi')
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
                                            <th>bidang 1</th>
                                            <th>bidang 2</th>
                                            <th>bidang 3</th>
                                            <th>bidang 4</th>
                                            <th>bidang lainnya</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Tanggal Konfirmasi</th>
                                            <th>Status</th>
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
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_a').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_b').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_c').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_d').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/lainnya').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download</button>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($sw->created_at)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($sw->tanggal_konfirmasi)) }}</td>
                                            <td>
                                                {!! $sw->status !!}
                                            </td>
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
