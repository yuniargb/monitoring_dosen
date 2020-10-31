@extends('layout')
@section('title', 'Data Review Ditolak')
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
                                            <th>Dokumen Pengajuan Dosen</th>
                                            <th>Dokumen Pengajuan Review</th>
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
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_a').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download Bidang A</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_b').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download Bidang B</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_c').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download Bidang C</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/bidang_d').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download Bidang D</button>
                                           
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/pengajuan/detailfile/lainnya').'/'.$sw->id_pengajuan }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download Lainnya</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary detail-bukti btn-sm mb-2"
                                                    data-download="{{url('/pengajuan/download')}}" data-url="{{ url('/review/detailfile').'/'.$sw->id_review }}" data-toggle="modal"
                                                    data-target="#exampleModal">Download</button>
                                            </td>
                                            <td>
                                                {!! $sw->status_text !!}
                                            </td>
                                            <td>{{ $sw->pesan_revisi }}</td>
                                            <td>{{ date('d-m-Y', strtotime($sw->tanggal_tolak)) }}</td>
                                            <td><p class="text-{{ $sw->umur <= 10 ? 'success' : ($sw->umur <= 20 ? 'warning' : 'danger') }}">{{ $sw->umur }} Hari</p></td>
                                            <td>
                                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                                    <div class="mx-3">
                                                        <a href="/review/form/{{ Crypt::encrypt($sw->id_review) }}" class="btn btn-primary btn-round btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if(auth()->user()->role != 2 )
                                                    <div class="mx-3">
                                                        
                                                        <form action="/review/konfirmasi/{{ Crypt::encrypt($sw->id_review) }}"
                                                            method="post" class="d-inline btn-confirm">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fas fa-check-circle"></i>
                                                            </button>
                                                        </form>
                                                        <a href="/review/form/tolak/{{ Crypt::encrypt($sw->id_review) }}" class="btn btn-warning btn-round btn-sm">
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
