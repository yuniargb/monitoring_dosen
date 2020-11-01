@extends('layout')
@section('title', 'Laporan Data Pengajuan')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Laporan Pengajuan</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/cetaklaporanpengajuan" id="pengajuanForm" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="from">Dari Tanggal</label>
                                        <input type="date" required class="form-control" name="from" id="from"
                                            value="{{ $req == null ? '' : $req->from != '' ? $req->from : '' }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="to">Sampai Tanggal</label>
                                        <input type="date" required class="form-control" name="to" id="to"
                                            value="{{ $req == null ? '' : $req->to != '' ? $req->to : '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fakultas">Fakultas</label>
                                    <select class="form-control" name="fakultas" id="fakultas">
                                        @foreach($fakultas as $k)
                                        <option value="{{ $k->id_fakultas }}"
                                            {{ $req == null ? '' : $req->fakultas == $k->id_fakultas ? "selected" : "" }}>
                                            {{ $k->nama_fakultas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_staf">Status Staff</label>
                                    <select class="form-control" name="status_staf" id="status_staf">
                                        <option value=""
                                            {{ $req == null ? '' : $req->status_staf == '' ? "selected" : "" }}>
                                            Semua
                                        </option>
                                        <option value="2"
                                            {{ $req == null ? '' : $req->status_staf == '2' ? "selected" : "" }}>
                                            Dikonfirmasi
                                        </option>
                                        <option value="3"
                                            {{ $req == null ? '' : $req->status_staf == '3' ? "selected" : "" }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_baak">Status BAAK</label>
                                    <select class="form-control" name="status_baak" id="status_baak">
                                        <option value=""
                                            {{ $req == null ? '' : $req->status_baak == '' ? "selected" : "" }}>
                                            Semua
                                        </option>
                                        <option value="2"
                                            {{ $req == null ? '' : $req->status_baak == '2' ? "selected" : "" }}>
                                            Dikonfirmasi
                                        </option>
                                        <option value="3"
                                            {{ $req == null ? '' : $req->status_baak == '3' ? "selected" : "" }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_dupak">Status DUPAK</label>
                                    <select class="form-control" name="status_dupak" id="status_dupak">
                                        <option value=""
                                            {{ $req == null ? '' : $req->status_dupak == '' ? "selected" : "" }}>
                                            Semua
                                        </option>
                                        <option value="2"
                                            {{ $req == null ? '' : $req->status_dupak == '2' ? "selected" : "" }}>
                                            Dikonfirmasi
                                        </option>
                                        <option value="3"
                                            {{ $req == null ? '' : $req->status_dupak == '3' ? "selected" : "" }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_pak">Status PAK</label>
                                    <select class="form-control" name="status_pak" id="status_pak">
                                        <option value=""
                                            {{ $req == null ? '' : $req->status_pak == '' ? "selected" : "" }}>
                                            Semua
                                        </option>
                                        <option value="2"
                                            {{ $req == null ? '' : $req->status_pak == '2' ? "selected" : "" }}>
                                            Dikonfirmasi
                                        </option>
                                        <option value="3"
                                            {{ $req == null ? '' : $req->status_pak == '3' ? "selected" : "" }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_sk">Status SK</label>
                                    <select class="form-control" name="status_sk" id="status_sk">
                                        <option value=""
                                            {{ $req == null ? '' : $req->status_sk == '' ? "selected" : "" }}>
                                            Semua
                                        </option>
                                        <option value="2"
                                            {{ $req == null ? '' : $req->status_sk == '2' ? "selected" : "" }}>
                                            Dikonfirmasi
                                        </option>
                                        <option value="3"
                                            {{ $req == null ? '' : $req->status_sk == '3' ? "selected" : "" }}>
                                            Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="modal-footer col-md-12">
                                    <div class="modal-footer col-md-12">
                                        <button name="submit" type="submit" class="btn btn-success"
                                            value="read">Tampil</button>
                                        <button name="submit" type="submit" class="btn btn-primary" value="pdf">Download
                                            PDF</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($laporan))
        <div class="card mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Laporan Pengajuan</h6>
            </div>
            <div class="card-body">
                <table border="1" class="table table-responsive table-bordered table-condensed table basic-datatables">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">NIDN</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Jabatan</th>
                            <th rowspan="2">Fakultas</th>
                            <th rowspan="2">Prodi</th>
                            <th rowspan="2">Umur</th>
                            <th colspan="2">Status</th>
                        </tr>
                        <tr>
                            <th>Bagian</th>
                            <th>Stat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $sw)
                        <tr>
                            <td rowspan="5">{{ $loop->iteration }}</td>
                            <td rowspan="5">{{ $sw->id_pengajuan }}</td>
                            <td rowspan="5">{{ date('d-m-Y', strtotime($sw->created_at)) }}</td>
                            <td rowspan="5">{{ $sw->nidn }}</td>
                            <td rowspan="5">{{ $sw->nama }}</td>
                            <td rowspan="5">{{ $sw->jabatan_fungsional }}</td>
                            <td rowspan="5">{{ $sw->nama_fakultas }}</td>
                            <td rowspan="5">{{ $sw->nama_prodi }}</td>
                            <td rowspan="5">{{ $sw->umur }}</td>
                            <td><b>Staff</b></td>
                            <td>{!! $sw->status_staf !!}</td>
                        </tr>
                        <tr>
                            <td><b>BAAK</b></td>
                            <td>{!! $sw->status_baak !!}</td>
                        </tr>
                        <tr>
                            <td><b>DUPAK</b></td>
                            <td>{!! $sw->status_dupak !!}</td>
                        </tr>
                        <tr>
                            <td><b>PAK</b></td>
                            <td>{!! $sw->status_pak !!}</td>
                        </tr>
                        <tr>
                            <td><b>SK</b></td>
                            <td>{!! $sw->status_sk !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
        @endif
       
    </div>
</div>
@stop
