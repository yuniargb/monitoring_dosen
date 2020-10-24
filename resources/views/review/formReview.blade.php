@extends('layout')
@section('title', 'Data Review')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ $type ? 'Konfirmasi' : 'Tolak'  }} {{ $title }}</div>
                    <a href="/review/" class="btn btn-danger btn-sm">
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
                <form action="/review/{{ $type ? 'update/' . Crypt::encrypt($data->id_review) : 'tolak/'. Crypt::encrypt($data->id_review) }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    @method('put')
                   

                    @if($type)
                        @php
                        $i = 1;
                        while($i <= 10){
                            $ft = 'foto_' . $i .'_r';
                        @endphp
                        <div class="form-group">
                            <label for="{{ $ft }}">Foto {{ $i }}</label>
                            <input type="file" class="form-control" value="{{ !$type ? $data->$ft : ''}}" name="{{ $ft }}" id="{{ $ft }}">
                        </div>
                        @php
                            $i++;
                        }                        
                        @endphp
                    @else
                        <div class="form-group">
                            <label for="pesan_revisi">Pesan</label>
                            <textarea name="pesan_revisi" id="pesan_revisi" cols="30" rows="10" class="form-control" required>{{ $type > 1 ? $data->pesan_revisi : ''}}</textarea>
                        </div>
                    @endif
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

