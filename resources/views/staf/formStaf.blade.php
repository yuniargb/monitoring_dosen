@extends('layout')
@section('title', 'Data Staf')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ $type ? 'Tambah' : 'Edit' }} {{ $title }}</div>
                    <a href="/admin/staf/" class="btn btn-danger btn-sm">
                        <span class="btn-label">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/admin/staf/{{ $type ? 'add' : 'update/'. Crypt::encrypt($data->id) }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    @if($type)
                        @method('post')
                    @else
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input required type="text" class="form-control" value="{{ !$type ? $data->username : ''}}" name="username" id="username" {{ !$type ? 'readonly' : ''}}>
                        <input required type="hidden" class="form-control" value="2" name="role" id="role">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required type="email" class="form-control" value="{{ !$type ? $data->email : ''}}" name="email" id="email" {{ !$type ? 'readonly' : ''}}>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input required type="text" class="form-control" value="{{ !$type ? $data->nama : ''}}" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="id_fakultas">Fakultas</label>
                        <select class="form-control" name="id_fakultas" id="id_fakultas" required>
                            <option value="" disabled>Pilih Fakultas</option>
                            @foreach($fakultas as $sw)
                            <option value="{{ $sw->id_fakultas }}" {{ !$type ? $data->id_fakultas == $sw->id_fakultas ? 'selected' : '' : ''}}>{{ $sw->nama_fakultas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" value="" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telfon</label>
                        <input required type="text" class="form-control" value="{{ !$type ? $data->no_telp : ''}}" name="no_telp" id="no_telp">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
