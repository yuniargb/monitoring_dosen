@extends('layout')
@section('title', 'Data Fakultas')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ $type ? 'Tambah' : 'Edit' }} {{ $title }}</div>
                    <a href="/admin/fakultas/" class="btn btn-danger btn-sm">
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
                <form action="/admin/fakultas/{{ $type ? 'add' : 'update/'. Crypt::encrypt($data->id_fakultas) }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    @if($type)
                        @method('post')
                    @else
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="nama_fakultas">Nama Fakultas</label>
                        <input required type="text" class="form-control" value="{{ !$type ? $data->nama_fakultas : ''}}" name="nama_fakultas" id="nama_fakultas">
                    </div>
                    <div class="form-group">
                        <label for="warna">Warna Fakultas</label>
                        <input required type="color" class="form-control" value="{{ !$type ? $data->warna : ''}}" name="warna" id="warna">
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

