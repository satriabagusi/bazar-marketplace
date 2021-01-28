<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/image-uploader/css/image-uploader.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/jquery-exzoom/css/jquery.exzoom.css')}}" rel="stylesheet" type="text/css">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
                @if (Auth::guard('merchant')->check())
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/merchant/dashboard">
                        <div class="sidebar-brand-text mx-3">Merchant Dashboard</div>
                    </a>
                    @elseif(Auth::guard('pembeli')->check())
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/pembeli/dashboard">
                        <div class="sidebar-brand-text mx-3">Pembeli Dashboard</div>
                    </a>
                    @elseif(Auth::guard('superuser')->check())
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/superuser/dashboard">
                        <div class="sidebar-brand-text mx-3">Super User Dashboard</div>
                    </a>
                @endif

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link " href="/" >
                    <i class="fas fa-home"></i>
                    <span>Halaman Utama</span>
                </a>
            </li>


            <hr class="sidebar-divider my-0">


            <!-- Heading -->
            <div class="sidebar-heading mt-2">
                Manage
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @if(Auth::guard('merchant')->check())
            <li class="nav-item @yield('active')">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-store active"></i>
                    <span>Produk</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Produk :</h6>
                        <a class="collapse-item @yield('tambah-produk')" href="/merchant/dashboard/tambah-produk">Tambah Produk</a>
                        <a class="collapse-item @yield('daftar-produk')" href="/merchant/dashboard/daftar-produk">Daftar Produk</a>
                        {{-- <a class="collapse-item @yield('detail-produk')" href="cards.html">Detail Produk</a> --}}
                    </div>
                </div>
            </li>
            @endif

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item @yield('transaksi')">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-receipt"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Transaksi :</h6>
                        @if (Auth::guard('merchant')->check())
                            <a class="collapse-item @yield('riwayat-transaksi')" href="/merchant/dashboard/transaksi">Riwayat Transaksi</a>
                            <a class="collapse-item @yield('tukar-poin')" href="#">Tukar Poin</a>
                        @elseif(Auth::guard('pembeli')->check())
                            <a class="collapse-item @yield('riwayat-transaksi')" href="/pembeli/dashboard/transaksi">Riwayat Transaksi</a>
                            <a class="collapse-item @yield('tukar-poin')" href="#">Tukar Poin</a>
                        @elseif(Auth::guard('superuser')->check())
                            <a class="collapse-item @yield('riwayat-transaksi')" href="/superuser/dashboard/transaksi">Daftar Transaksi</a>
                        @endif
                    </div>
                </div>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

            {{-- <!-- Heading -->
            <div class="sidebar-heading">
                Pengaturan
            </div>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="/merchant/dashboard/akun">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Pengaturan Akun</span></a>
            </li> --}}

            @if(Auth::guard('superuser')->check())
            <div class="sidebar-heading mt-2">
                Akun
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item @yield('active')">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-store active"></i>
                    <span>Akun</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Akun :</h6>
                        <a class="collapse-item @yield('daftar-merchant')" href="/superuser/dashboard/daftar-merchant">Daftar Merchant</a>
                        <a class="collapse-item @yield('tambah-user')" href="/superuser/dashboard/tambah-user">Tambah Superuser</a>
                        {{-- <a class="collapse-item @yield('detail-produk')" href="cards.html">Detail Produk</a> --}}
                    </div>
                </div>
            </li>
            @endif


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-star"></i>
                                <!-- Point - Messages -->
                                @if (Auth::guard('merchant')->check())
                                <span class="text-info font-weight-bold mt-1 ml-1">{{Auth::guard('merchant')->user()->point_merchant}}</span>
                                @elseif(Auth::guard('pembeli')->check())
                                <span class="text-info font-weight-bold mt-1 ml-1">{{Auth::guard('pembeli')->user()->point_pembeli}}</span>
                                @endif
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Poin
                                </h6>
                                <div class="dropdown-item d-flex align-items-center">
                                    <div class="font-weight-bold">
                                        @if (Auth::guard('merchant')->check())
                                        <span class="text-secondary font-weight-bold ">Setiap Transaksi sebesar 200.000 akan mendapatkan 1 Poin (berlaku kelipatannya)</span>
                                        <span class="text-secondary font-weight-bold ">Tukarkan 25 Poin untuk mendapatkan kesempatan undian Doorprizes</span>
                                        @elseif(Auth::guard('pembeli')->check())
                                        <span class="text-secondary font-weight-bold ">Setiap Transaksi sebesar 5.000 akan mendapatkan 1 Poin (berlaku kelipatannya)</span>
                                        <ul>
                                            <li class="text-secondary font-weight-bold ">Tukarkan 30 Poin untuk mendapatkan kesempatan Doorprizes berupa Hiburan</li>
                                            <li class="text-secondary font-weight-bold ">Tukarkan 60 Poin untuk mendapatkan kesempatan Doorprizes ke-5</li>
                                            <li class="text-secondary font-weight-bold ">Tukarkan 70 Poin untuk mendapatkan kesempatan Doorprizes ke-4</li>
                                            <li class="text-secondary font-weight-bold ">Tukarkan 80 Poin untuk mendapatkan kesempatan Doorprizes ke-3</li>
                                            <li class="text-secondary font-weight-bold ">Tukarkan 90 Poin untuk mendapatkan kesempatan Doorprizes ke-2</;>
                                            <li class="text-secondary font-weight-bold ">Tukarkan 90 Poin untuk mendapatkan kesempatan Doorprizes UTAMA</li>
                                        </ul>

                                        @endif
                                    </div>
                                </div>
                                <a class="dropdown-item text-center foint-weight-bold text-primary" href="#">Tukar Poin</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::guard('merchant')->check())
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 ">{{Auth::guard('merchant')->user()->nama_merchant}}</span>
                                @elseif (Auth::guard('pembeli')->check())
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 ">{{Auth::guard('pembeli')->user()->nama_pembeli}}</span>
                                @elseif (Auth::guard('superuser')->check())
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 ">{{Auth::guard('superuser')->user()->nama}}</span>
                                @endif
                                <i class="fas fa-user-circle text-primary" style="font-size: 32px"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Lihat Profil
                                </a>
                                <a class="dropdown-item" href="#">
                                    @if (!Auth::guard('superuser')->check())
                                    <i class="fas fa-star fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Tukar Point
                                    @endif
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid  my-4">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('halaman')</h1>
                    </div>

                    {{-- <div class="row">
                        <nav aria-label="Page filter">
                            <p>Filter transaksi</p>
                            <ul class="pagination">
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Transaksi Selesai">
                                  <span aria-hidden="true">Transaksi Selesai</span>
                                </a>
                              </li>
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Transaksi Belum Selesai">
                                  <span aria-hidden="true">Transaksi Belum Selesai</span>
                                </a>
                              </li>
                            </ul>
                          </nav>
                    </div> --}}
                    <!-- Content Row -->
                        @yield('content')




                    <!-- Content Row -->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <p>Created by</p>
                            <a target="_blank" href="https://www.instagram.com/groove_creative/">
                            <img class="img-fluid" width="150px" src="/img/GROOVE2.png" alt="">
                            </a>
                        </div>
                        <div class="col-8 d-flex justify-content-center">
                            <div class="">
                                <p class="m-0 text-center ">Copyright &copy; Bazar Bulan K3 {{date("Y")}}  Pertamina Balongan Indramayu </p>
                                <img class="img-fluid mt-3 ml-2" width="320px" src="/img/bumn-pertamina.jpg" alt="">
                                <img class="img-fluid mt-3" width="70px" src="/img/sppbb.png" alt="">
                            </div>
                        </div>
                        <div class="col-2">
                            Jangan lupa <a class="text-decoration-none" href="https://covid19.go.id/">#PAKAIMASKER</a>
                        </div>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan <span class="badge badge-primary">Logout</span> untuk keuar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">
                        @if (Auth::guard('merchant'))
                        <a class="text-decoration-none text-white" href="/merchant/logout">
                            Logout
                        </a>
                        @elseif (Auth::guard('pembeli'))
                        <a class="text-decoration-none text-white" href="/pembeli/logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        @elseif (Auth::guard('superuser'))
                        <a class="text-decoration-none text-white" href="/superuser/logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if ($status = Session::get('status'))
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="statusModal">Notifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-auto">
                <div class="row d-flex justify-content-center">
                    <strong>{{$status}}</strong>
                </div>
            </div>
            </div>
        </div>
    </div>
    @endif



    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/jquery-mask/jquery.mask.js')}}"></script>
    <script src={{asset('vendor/bootstrap/js/bootstrap.bundle.js')}}></script>
    <script src="{{asset('vendor/image-uploader/js/image-uploader.js')}}"></script>
    <script src="{{asset('vendor/jquery-exzoom/js/jquery.exzoom.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('js/demo/chart-area-demo.js')}}"></script> --}}
    {{-- <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script> --}}

    <script src="{{asset('js/script.js')}}"></script>


</body>

</html>
