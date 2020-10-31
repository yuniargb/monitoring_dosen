@extends('layout')
@section('title', 'Data BAAK')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ $type ? 'Tambah' : 'Edit' }} {{ $title }}</div>
                    <a href="/admin/baak/" class="btn btn-danger btn-sm">
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
                <form action="/admin/baak/{{ $type ? 'add' : 'update/'. Crypt::encrypt($data->id) }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    @if($type)
                        @method('post')
                    @else
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input required type="text" class="form-control" value="{{ !$type ? $data->username : ''}}" name="username" id="username" {{ !$type ? 'readonly' : ''}}>
                        
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
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telfon</label>
                        <input required type="text" class="form-control" value="{{ !$type ? $data->no_telp : ''}}" name="no_telp" id="no_telp">
                    </div>
                    <div class="form-group">
                        <label for="role">Bagian</label>
                        <select class="form-control" name="role" id="role" required>
                            <option value="" disabled>Pilih Bagian</option>
                            <option value="3" {{ !$type ? ($data->role == 3 ? 'selected' : '') : ''}}>BAAK</option>
                            <option value="5" {{ !$type ? ($data->role == 5 ? 'selected' : '') : ''}}>DUPAK</option>
                            <option value="6" {{ !$type ? ($data->role == 6 ? 'selected' : '') : ''}}>PAK</option>
                            <option value="7" {{ !$type ? ($data->role == 7 ? 'selected' : '') : ''}}>SK</option>
                            
                        </select>
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
