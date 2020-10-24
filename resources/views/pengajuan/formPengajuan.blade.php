@extends('layout')
@section('title', 'Data Pengajuan')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ $type ? 'Tambah' : 'Edit' }} {{ $title }}</div>
                    <a href="/pengajuan/" class="btn btn-danger btn-sm">
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
                <form action="/pengajuan/{{ $type ? 'add' : 'update/'. Crypt::encrypt($data->id_pengajuan) }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    @if(!$type)
                        @method('put')
                    @else
                        @method('post')
                    @endif

                    
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input required type="text" class="form-control" value="{{ !$type ? $data->nama : ''}}" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="nidn">NIDN</label>
                        <input required  type="text" class="form-control" value="{{ !$type ? $data->nidn : (auth()->user()->role == 3 ? auth()->user()->username : '')}}" name="nidn" id="nidn" {{ auth()->user()->role == 3 ? 'readonly' : ''}}>
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
                        <label for="id_prodi">Prodi</label>
                        <select class="form-control" name="id_prodi" id="id_prodi" required>
                            <option value="" disabled>Pilih Fakultas</option>
                            @foreach($prodi as $sw)
                            <option value="{{ $sw->id_prodi }}" {{ !$type ? $data->id_prodi == $sw->id_prodi ? 'selected' : '' : ''}}>{{ $sw->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pesan">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" required>{{ !$type ? $data->alamat : ''}}</textarea>
                    </div>
                    @php
                    $i = 1;
                    while($i <= 4){
                        $ft = 'foto_' . $i;
                    @endphp
                    <div class="form-group">
                        <label for="{{ $ft }}">Foto {{ $i }}</label>
                        <input type="file" class="form-control" value="{{ !$type ? $data->$ft : ''}}" name="{{ $ft }}" id="{{ $ft }}">
                    </div>
                    @php
                        $i++;
                    }                        
                    @endphp
                    
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

