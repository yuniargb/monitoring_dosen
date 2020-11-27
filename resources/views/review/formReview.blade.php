@extends('layout')
@section('title', 'Data Review')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ $type == 1 ? 'Revisi' : ($type == 2 ? 'Konfirmasi' : 'Tolak')  }} {{ $title }}</div>
                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">
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
                <form action="/review/{{ $type == 1 ? 'update/' . Crypt::encrypt($data->id_review) : ( $type == 2 ? 'konfirmasi/'. Crypt::encrypt($data->id_review) : 'tolak/'. Crypt::encrypt($data->id_review) )  }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    @method('put')
                   

                    <input required type="hidden" class="form-control" value="{{ url()->previous() }}" name="prevUrl" id="prevUrl">
                    @if($type == 1)
                    
                       <div class="form-group">
                            <label for="basnat">BA SENAT</label>
                               @foreach ($basnat as $b)
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ $b->dokumen }}
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" data-action="/api/review/dokumen/delete/{{ Crypt::encrypt($b->id_dokumen_review) }}" class="btn btn-danger btn-sm mb-2 btn-delt"
                                                    data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            <input type="file" class="form-control" name="basenat[]" id="basnat" required>
                        </div>
                        <div id="data-ba_senat"></div>
                        <button class="btn btn-primary mb-1 btn-sm text-right btn-ba_senat" type="button"><i class="fas fa-plus"></i> Tambah BA SENAT</button>
                    @elseif($type == 2)
                        @if($data->dupak == null)
                            <div class="form-group">
                                <label for="dupak">DUPAK</label>
                                <input required type="file" class="form-control" value="{{ !$type ? $data->dupak : ''}}" name="dupak" id="dupak">
                            </div>
                        @elseif($data->pak == null)
                            <div class="form-group">
                                <label for="pak">PAK</label>
                                <input required type="file" class="form-control" value="{{ !$type ? $data->pak : ''}}" name="pak" id="pak">
                            </div>
                        @elseif($data->sk == null)
                            <div class="form-group">
                                <label for="sk">SK</label>
                                <input required type="file" class="form-control" value="{{ !$type ? $data->sk : ''}}" name="sk" id="sk">
                            </div>
                        @endif
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

