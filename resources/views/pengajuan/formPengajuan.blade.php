@extends('layout')
@section('title', 'Data Pengajuan')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ $type ? 'Tambah' : 'Edit' }} {{ $title }}</div>
                    <!-- <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">
                        <span class="btn-label">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        Kembali
                    </a> -->
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
                        <input required type="hidden" class="form-control" value="{{ url()->previous() }}" name="prevUrl" id="prevUrl">
                    </div>
                    <div class="form-group">
                        <label for="nidn">NIDN</label>
                        <input required  type="text" class="form-control" value="{{ !$type ? $data->nidn : (auth()->user()->role == 4 ? auth()->user()->username : '')}}" name="nidn" id="nidn" {{ auth()->user()->role == 4 ? 'readonly' : ''}}>
                    </div>
                    <div class="form-group">
                        <label for="jabatan_fungsional">Jabatan Fungsional</label>
                        <select class="form-control" name="jabatan_fungsional" id="jabatan_fungsional" required>
                            <option value="" disabled>Pilih Jabatan</option>
                            <option {{ !$type ? ($data->jabatan_fungsional == 'Tenaga Pengajar' ? 'selected' : '') : '' }}>Tenaga Pengajar</option>
                            <option {{ !$type ? ($data->jabatan_fungsional == 'Asisten Ahli' ? 'selected' : '') : '' }}>Asisten Ahli</option>
                            <option {{ !$type ? ($data->jabatan_fungsional == 'Lektor' ? 'selected' : '') : '' }}>Lektor</option>
                            <option {{ !$type ? ($data->jabatan_fungsional == 'Lektor Kepala' ? 'selected' : '') : '' }}>Lektor Kepala</option>
                            <option {{ !$type ? ($data->jabatan_fungsional == 'Guru Besar' ? 'selected' : '') : '' }}>Guru Besar</option>
                            
                        </select>
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
                    $i = 'a';
                    while($i <= 'd'){
                        $ft = 'bidang_' . $i;

                    @endphp
                    <div class="form-group">
                        <label for="{{ $ft }}" class="text-capitalize">Bidang {{ $i }}</label>
                        
                            @if($ft == 'bidang_a')
                                <small id="emailHelp" class="form-text text-muted">Ijazah, SK Mengajar, SK Sidang,Penguji KP & Skripsi, Buat buku, Modul, SK Jabatan Perguruan Tinggi, Materi Absen Dosen & Mahasiswa</small>
                                @if(!$type)
                                
                                @foreach ($bidang_a as $b)
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ $b->dokumen }}
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" data-action="/api/pengajuan/dokumen/delete/{{ Crypt::encrypt($b->id_dokumen_pengajuan) }}" class="btn btn-danger btn-sm mb-2 btn-delt"
                                                    data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            @elseif($ft == 'bidang_b')
                                <small id="emailHelp" class="form-text text-muted">Jurnal Nasional & Internasional, Buku Ilmiah</small>
                                @if(!$type)
                                @foreach ($bidang_b as $b)
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ $b->dokumen }}
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" data-action="/api/pengajuan/dokumen/delete/{{ Crypt::encrypt($b->id_dokumen_pengajuan) }}" class="btn btn-danger btn-sm mb-2 btn-delt"
                                                    data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            @elseif($ft == 'bidang_c')
                                <small id="emailHelp" class="form-text text-muted">Surat Pelaksanaan Pengabdian pada masyarakat, surat tugas sertifikat pengabdian pada masyarakat</small>
                                @if(!$type)
                                @foreach ($bidang_c as $b)
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ $b->dokumen }}
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" data-action="/api/pengajuan/dokumen/delete/{{ Crypt::encrypt($b->id_dokumen_pengajuan) }}" class="btn btn-danger btn-sm mb-2 btn-delt"
                                                    data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            @elseif($ft == 'bidang_d')
                                <small id="emailHelp" class="form-text text-muted">Penunjang tugas dosen, anggota organisasi profesi, menulis buku pelajaran SLTA, Prestasi Bidang Olahraga</small>
                                @if(!$type)
                                @foreach ($bidang_d as $b)
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ $b->dokumen }}
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" data-action="/api/pengajuan/dokumen/delete/{{ Crypt::encrypt($b->id_dokumen_pengajuan) }}" class="btn btn-danger btn-sm mb-2 btn-delt"
                                                    data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            @endif
                        <input type="file" class="form-control" value="{{ !$type ? $data->$ft : ''}}" name="{{ $ft }}[]" {{ !$type ? '' : 'required'}}>
                    </div>
                    <div id="data-{{ $ft }}"></div>
                    <button class="btn btn-primary mb-1 btn-sm text-right btn-{{ $ft }} text-capitalize" type="button"><i class="fas fa-plus"></i> Tambah Bidang {{ $i }}</button>
                    @php
                        $i++;
                    }                        
                    @endphp
                    <div class="form-group">
                        <label for="lainnya">Bidang Lainnya</label>
                        @if(!$type)
                        @foreach ($lainnya as $b)
                            <div class="row">
                                <div class="col-md-10">
                                    {{ $b->dokumen }}
                                </div>
                                <div class="col-md-2">
                                    <button type="button" data-action="/api/pengajuan/dokumen/delete/{{ Crypt::encrypt($b->id_dokumen_pengajuan) }}" class="btn btn-danger btn-sm mb-2 btn-delt"
                                            data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        <input type="file" class="form-control" value="{{ !$type ? $data->lainnya : ''}}" name="lainnya[]" id="lainnya">
                    </div>
                    <div id="data-bidang_lainnya"></div>
                    <button class="btn btn-primary mb-1 btn-sm text-right btn-bidang_lainnya" type="button"><i class="fas fa-plus"></i> Tambah Bidang Lainnya</button>
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

