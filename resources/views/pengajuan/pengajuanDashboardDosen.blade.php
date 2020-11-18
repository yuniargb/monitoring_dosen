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
                                            <th>Tanggal</th>
                                            <th>Pengajuan</th>
                                            <th>Dokumen</th>
                                            <th>Status Staf</th>
                                            <th>Status BAAK</th>
                                            <th>Status DUPAK</th>
                                            <th>Status PAK</th>
                                            <th>Status SK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y',strtotime($sw->created_at)) }}</td>
                                            <td>
                                                <button class="btn btn-primary detail-pengajuan-dosen btn-sm"
                                                    data-toggle="modal"
                                                    data-fakultas="{{ $sw->nama_fakultas }}"
                                                    data-prodi="{{ $sw->nama_prodi }}"
                                                    data-alamat="{{ $sw->alamat }}"
                                                    data-nidn="{{ $sw->nidn }}"
                                                    data-nama="{{ $sw->nama }}"
                                                    data-jabatan="{{ $sw->jabatan_fungsional }}"
                                                    data-target="#exampleModalPengajuan">Lihat</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_a').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Bidang A</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_b').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Bidang B</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_c').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Bidang C</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_d').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Bidang D</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/lainnya').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Lainnya</button>
                                                @if($sw->id_review != null)
                                                    <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/review/detailfile').'/'.$sw->id_review }}" data-toggle="modal"
                                                    data-target="#exampleModal">Review</button>
                                                @endif
                                            </td>
                                            <td>
                                                @switch($sw->status)
                                                    @case(0)
                                                        <p class="text-warning">New</p>
                                                        @break
                                                    @case(1)
                                                         <p class="text-success">In Review</p>
                                                        @break
                                                    @case(2)
                                                         <p class="text-success">Konfirmasi</p>
                                                         <br/>
                                                         <p class="text-success">({{ date('d-m-Y',strtotime($sw->tanggal_konfirmasi)) }})</p>
                                                        @break
                                                    @case(3)
                                                         <p class="text-danger">Ditolak</p>
                                                         <br/>
                                                         <p class="text-danger">({{ date('d-m-Y',strtotime($sw->tanggal_tolak)) }})</p>
                                                         <p class="text-danger">Note : {{ $sw->pesan_revisi }}</p>
                                                         <div class="mx-3">
                                                            <a href="/pengajuan/form/{{ Crypt::encrypt($sw->id_pengajuan) }}" class="btn btn-primary btn-round btn-sm">
                                                                Revisi
                                                            </a>
                                                        </div>
                                                        @break
                                                    @case(4)
                                                         <p class="text-warning">Revisi</p>
                                                        @break
                                                    @default
                                                        <p class="text-danger">Menunggu</p>
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($sw->status_review)
                                                    @case(0)
                                                        <p class="text-warning">New</p>
                                                        @break
                                                    @case(1)
                                                         <p class="text-success">In Review</p>
                                                        @break
                                                    @case(2)
                                                         <p class="text-success">Konfirmasi</p>
                                                         <br/>
                                                         <p class="text-success">({{ date('d-m-Y',strtotime($sw->tanggal_konfirmasi_review)) }})</p>
                                                        @break
                                                    @case(3)
                                                         <p class="text-danger">Ditolak</p>
                                                         <br/>
                                                         <p class="text-danger">({{ date('d-m-Y',strtotime($sw->tanggal_tolak_review)) }})</p>
                                                         <p class="text-danger">Note : {{ $sw->pesan_revisi }}</p>
                                                        @break
                                                    @case(4)
                                                         <p class="text-warning">Revisi</p>
                                                        @break
                                                    @default
                                                        <p class="text-danger">Menunggu</p>
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($sw->status_dupak)
                                                    @case(0)
                                                        <p class="text-warning">New</p>
                                                        @break
                                                    @case(1)
                                                         <p class="text-success">In Review</p>
                                                        @break
                                                    @case(2)
                                                         <p class="text-success">Konfirmasi</p>
                                                         <br/>
                                                         <p class="text-danger">({{ date('d-m-Y',strtotime($sw->tanggal_konfirmasi_dupak)) }})</p>
                                                         <p class="text-danger">Note : {{ $sw->pesan_revisi }}</p>
                                                        @break
                                                    @case(3)
                                                         <p class="text-danger">Ditolak</p>
                                                         <br/>
                                                         <p class="text-danger">({{ date('d-m-Y',strtotime($sw->tanggal_tolak_dupak)) }})</p>
                                                         <p class="text-danger">Note : {{ $sw->pesan_revisi }}</p>
                                                        @break
                                                    @case(4)
                                                         <p class="text-warning">Revisi</p>
                                                        @break
                                                    @default
                                                        <p class="text-danger">Menunggu</p>
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($sw->status_pak)
                                                    @case(0)
                                                        <p class="text-warning">New</p>
                                                        @break
                                                    @case(1)
                                                         <p class="text-success">In Review</p>
                                                        @break
                                                    @case(2)
                                                         <p class="text-success">Konfirmasi</p>
                                                         <br/>
                                                         <p class="text-danger">({{ date('d-m-Y',strtotime($sw->tanggal_konfirmasi_pak)) }})</p>
                                                         <p class="text-danger">Note : {{ $sw->pesan_revisi }}</p>
                                                        @break
                                                    @case(3)
                                                         <p class="text-danger">Ditolak</p>
                                                         <br/>
                                                         <p class="text-success">({{ date('d-m-Y',strtotime($sw->tanggal_tolak_pak)) }})</p>
                                                        @break
                                                    @case(4)
                                                         <p class="text-warning">Revisi</p>
                                                        @break
                                                    @default
                                                        <p class="text-danger">Menunggu</p>
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($sw->status_sk)
                                                    @case(0)
                                                        <p class="text-warning">New</p>
                                                        @break
                                                    @case(1)
                                                         <p class="text-success">In Review</p>
                                                        @break
                                                    @case(2)
                                                         <p class="text-success">Konfirmasi</p>
                                                         <br/>
                                                         <p class="text-success">({{ date('d-m-Y',strtotime($sw->tanggal_konfirmasi_sk)) }})</p>
                                                        @break
                                                    @case(3)
                                                         <p class="text-danger">Ditolak</p>
                                                         <br/>
                                                         <p class="text-danger">({{ date('d-m-Y',strtotime($sw->tanggal_tolak_sk)) }})</p>
                                                         <p class="text-danger">Note : {{ $sw->pesan_revisi }}</p>
                                                        @break
                                                    @case(4)
                                                         <p class="text-warning">Revisi</p>
                                                        @break
                                                    @default
                                                        <p class="text-danger">Menunggu</p>
                                                @endswitch
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

<div class="modal fade" id="exampleModalPengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan</h5>
                <button type="button" class="Tutup" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <img src="" alt="" id="datagambar" class="img-fluid"> -->
                <div id="detail-pengajuan"></div>
            </div>
        </div>
    </div>
</div>
@stop
