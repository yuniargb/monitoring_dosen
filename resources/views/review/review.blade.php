@extends('layout')
@section('title', 'Data Review')
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
                                            <th>Dokumen Pengajuan Fakultas</th>
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
                                                    data-target="#exampleModal">Download Pengajuan Fakultas</button>
                                                    @if($sw->dupak != null)
                                                    <a href="{{url('/pengajuan/download')}}/{{$sw->dupak}}" class="btn btn-primary btn-round btn-sm w-100 text-light mt-3" target="_blank">
                                                    Download Dupak
                                                    </a>
                                                    @endif
                                                    @if($sw->pak != null)
                                                    <a href="{{url('/pengajuan/download')}}/{{$sw->pak}}" class="btn btn-primary btn-round btn-sm w-100 text-light mt-3" target="_blank">
                                                    Download PAK
                                                    </a>
                                                    @endif
                                                    @if($sw->sk != null)
                                                    <a href="{{url('/pengajuan/download')}}/{{$sw->sk}}" class="btn btn-primary btn-round btn-sm w-100 text-light mt-3" target="_blank">
                                                    Download SK
                                                    </a>
                                                    @endif
                                            </td>
                                            <td>{!! $sw->status_text !!}</td>
                                            <td><p class="text-{{ $sw->umur <= 10 ? 'success' : ($sw->umur <= 20 ? 'warning' : 'danger') }}">{{ $sw->umur }} Hari</p></td>
                                            
                                            <td>
                                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                                    <div class="mx-3">
                                                        @if( $sw->status == 3 || $sw->status == 4)
                                                         <a href="/review/form/{{ Crypt::encrypt($sw->id_review) }}" class="btn btn-primary btn-round btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @endif
                                                        @if( $sw->status == 0 || $sw->status == 1)
                                                        <form action="/api/review/delete/{{ Crypt::encrypt($sw->id_review) }}"
                                                            method="post" class="d-inline btn-del ">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if(auth()->user()->role == 1 || auth()->user()->role == 3 || auth()->user()->role == 5 || auth()->user()->role == 6 || auth()->user()->role == 7)
                                                    <div class="mx-3">

                                                        <!-- <form action="/review/konfirmasi/{{ Crypt::encrypt($sw->id_review) }}"
                                                            method="post" class="d-inline btn-confirm">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fas fa-check-circle"></i>
                                                            </button>
                                                        </form> -->
                                                        <a href="/review/form/konfirmasi/{{ Crypt::encrypt($sw->id_review) }}" class="btn btn-success btn-round btn-sm">
                                                            <i class="fas fa-check-circle"></i>
                                                        </a>
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
