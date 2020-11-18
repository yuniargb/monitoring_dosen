@extends('layout')
@section('title', 'Data Iklan')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                Edit {{ $title }}
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
                <form action="/admin/iklan/update/{{ Crypt::encrypt(1) }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    @method('put')
                 
                    <div class="form-group">
                        <label for="isi_iklan">Iklan</label>
                        <input required type="text" class="form-control" value="{{ $data->isi_iklan }}" name="isi_iklan" id="isi_iklan">
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
