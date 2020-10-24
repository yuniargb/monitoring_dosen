<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MONITORING SYSTEM - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/images/marker-icon.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/images/layers-2x.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/images/layers.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/images/marker-shadow.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" integrity="sha512-gc3xjCmIy673V6MyOAZhIW93xhM9ei1I+gLbmFjUHIjocENRsLX/QUE1htk5q1XV2D/iie/VQ8DXI6Vu8bexvQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css" integrity="sha512-vJfMKRRm4c4UupyPwGUZI8U651mSzbmmPgR3sdE3LcwBPsdGeARvUM5EcSTg34DK8YIRiIo+oJwNfZPMKEQyug==" crossorigin="anonymous" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">
    <!-- Data Tables Style -->
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Select2 Style -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.4.0/dist/select2-bootstrap4.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
</head>


<body id="page-top">
   

        <!-- Page Wrapper -->
        <div id="wrapper">

           
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <!-- <div class="sidebar-brand-icon">
                    <img src="/images/Logo1.png" alt="..." class="avatar-img rounded-circle" width="50">
                </div> -->
                    <div class="sidebar-brand-text mx-3">Selamat datang</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Menu
                </div>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li> -->
                

                @if(auth()->user()->role == 1)
                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="/admin/prodi">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Prodi</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/fakultas">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Fakultas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/dosen">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Dosen</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/staf">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Staf</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/baak">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data BAAK</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/admin">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Admin</span></a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
                @endif
                @if(auth()->user()->role == 1 || auth()->user()->role == 4 || auth()->user()->role == 2)
                <li class="nav-item">
                    <a class="nav-link" href="/pengajuan">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Pengajuan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pengajuan/konfirmasi">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Pengajuan Konfirmasi</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pengajuan/ditolak">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Pengajuan Ditolak</span></a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
                @endif
                @if(auth()->user()->role == 1 || auth()->user()->role == 3 || auth()->user()->role == 2)
                <li class="nav-item">
                    <a class="nav-link" href="/review">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Review</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/review/konfirmasi">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Review Konfirmasi</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/review/ditolak">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Data Review Ditolak</span></a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
                <li class="nav-item">
                    <a class="nav-link" href="/laporan">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span>Laporan</span></a>
                </li>
                @endif
                
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            @php
                            if(auth()->user()->role == 1){
                            $role = 'Superadmin';
                            }elseif(auth()->user()->role == 2){
                            $role = 'Staf';
                            }elseif(auth()->user()->role == 3){
                            $role = 'BAAK';
                            }elseif(auth()->user()->role == 4){
                            $role = 'Dosen';
                            }else{
                            $role = 'None';
                            }
                            @endphp

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>Login Sebagai : {{ $role }}</span>
                                    <div class="topbar-divider d-none d-sm-block"></div>
                                    <span class="text-capitalize text-bold">Hi, {{ auth()->user()->nama }}</span>
                                   
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="/user">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item btn-logout" href="/logout">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
         
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        @if(trim($__env->yieldContent('sidebar')) == null)
                        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
                        @endif
                        @if(trim($__env->yieldContent('sidebar')) == null)
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if ($message = Session::get('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @endif
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Gambar</h5>
                    <button type="button" class="Tutup" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="datagambar" class="img-fluid">
                </div>
                <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="/assets/vendor/jquery/jquery.min.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <!-- Data Tables -->
        <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Chart -->
        <script src="/assets/vendor/chart.js/Chart.min.js"></script>
        <!-- Select 2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="/assets/js/chart.js"></script>

        <!-- Text Editor -->
        <script src="https://cdn.tiny.cloud/1/wcb9pe2k9npdjl15ggu0oad1k88dnph0q8qit0pfc1q5bkix/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>

        <!-- Custom scripts for all pages-->
        <script src="/assets/js/sb-admin-2.min.js"></script>
        <script src="/assets/js/script.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>


        <!-- <script>
            tinymce.init({
                selector: 'textarea.editor',
                plugins: "table | lists | image",
                table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | insert",
                toolbar: "numlist bullist align image",
            });
            
        </script> -->
        <script>
            var token_map = 'pk.eyJ1IjoieXVuaWFyZ2IiLCJhIjoiY2tnZHdyOHdlMTR4eTJ0czVudWV4ZG4zNCJ9.h62ok3-Np4yxFRc8czYvuQ';
        </script>
        @yield('map-script');
        <script>
            $(document).ready(function () {
                $('.basic-datatables').DataTable();
                $('.btn-passs').on('click', function (e) {
                    console.log('ok')
                    let url = $(this).attr('href')
                    console.log(url)
                    let text = $(this).data('original-title')
                    e.preventDefault();
                    Swal.fire({
                        title: 'Kamu yakin ingin merubah kata sandi',
                        text: "kata sandi secara default akan dirubah ke tanggal lahir siswa!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: text
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = url;
                        }
                    });
                });
            });

        </script>
    </body>

</html>
