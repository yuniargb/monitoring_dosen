@extends('layout')
@section('title', 'Dashboard Fakultas Pengajuan')
@section('content')

<div class="page-inner mt--5">
    <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <a href="/pengajuan/dosen" class="text-decoration-none">
                  <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jumlah Dosen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dosen->jumlah }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                      
                        </div>
                    </div>
                    </div>
                </div>
              </a>
            </div>
            
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="/pengajuan" class="text-decoration-none">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Usulan Baru</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $new->jumlah }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-ribbon fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
           
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="/pengajuan" class="text-decoration-none">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">In Review</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $review->jumlah }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-eye fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-xl-4 col-md-6 mb-4">
              <a href="/pengajuan/konfirmasi" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Faculty complete</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $konfirm->jumlah }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            <div class="col-xl-4 col-md-6 mb-4">
              <a href="/pengajuan/ditolak" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Need Revisi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $revisi->jumlah }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            
            <div class="col-xl-4 col-md-6 mb-4">
              <a href="/pengajuan/ditagguhkan" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ditagguhkan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ditagguhkan->jumlah }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-unlink fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
</div>
@stop
