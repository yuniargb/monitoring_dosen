@extends('layout')
@section('content')
<div class="page-inner mt--5">
    <!-- Content Row -->
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <h3>Selamat Datang <b class="text-primary">{{ auth()->user()->nama }}</b>
                            </h3>
                           
                            <h5>Anda login sebagai <b class="text-primary">{{ auth()->user()->nama }}</b>
                            </h5>
                            <p class="text-justify">TEST</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
