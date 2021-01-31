<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>@yield('title')</title>

<!-- Bootstrap core CSS -->
<link href="{{asset('/css/sb-admin-2.css')}}" rel="stylesheet">
<link href="{{asset('vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">


<!-- Custom styles for this template -->
<link href="{{asset('css/shop-homepage.css')}}" rel="stylesheet">
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg mr-auto ml-auto navbar-light bg-white fixed-top shadow-sm">
<div class="container-fluid">
    <div class="">
        <img src="{{asset('img/logo-pertamina.png')}}" alt="" width="50px">
        <a class="navbar-brand" href="/">Bazar Bulan K3 2021</a>
    </div>

    <div class="justify-content-md-center">
        <form class="form-inline input-group" method="GET" action="/produk/cari/?produk=">
            <input class="form-control" type="text" name="produk" placeholder="Cari produk ..." aria-label="Search" style="width: 300px;" autocomplete="off">
            <div class="input-group-append">
                <button class=" btn btn-primary " id="basic-addon2"><ion-icon name="search"></ion-icon></button>
            </div>
            {{-- <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button> --}}
        </form>
    </div>
    <div class="row">


        <div class="col-xs-auto py-2">
            @if (Auth::guard('merchant')->check() || Auth::guard('pembeli')->check())
            <div class=" ">
                <a class="nav-link " href="#" id="messagesDropdown" role="button"
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
                    <a class="dropdown-item bg-primary text-light text-center foint-weight-bold" href="#">Tukar Poin</a>
                </div>
        </div>
        @endif
        </div>

        <div class="col-xs-auto">
            <button class="navbar-toggler mt-2 mr-5" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <ion-icon name="menu"></ion-icon>
        </div>

        </button>



        <div class="collapse navbar-collapse py-1" id="navbarSupportedContent">

        @if (Auth::guard('merchant')->check())
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                {{Auth::guard('merchant')->user()->nama_merchant}}
            </span>
            <i class="fas fa-user-circle text-primary " style="font-size: 20px"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow mr-5"
            aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/merchant/dashboard">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Dashboard
                </a>
                <a class="dropdown-item" href="/merchant/dashboard/akun">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pengaturan Akun
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
        </div>
        @elseif(Auth::guard('pembeli')->check())
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                {{Auth::guard('pembeli')->user()->nama_pembeli}}
            </span>
            <i class="fas fa-user-circle text-primary " style="font-size: 20px"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow mr-5"
            aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/pembeli/dashboard">
                    <i class="fas fa-cash-register fa-fw mr-2 text-gray-400"></i>
                    Transaksi
                </a>
                <a class="dropdown-item" href="/pembeli/dashboard/akun">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pengaturan Akun
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
        </div>
        @elseif(Auth::guard('superuser')->check())
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                {{Auth::guard('superuser')->user()->nama}}
            </span>
            <i class="fas fa-user-circle text-primary " style="font-size: 20px"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow mr-5"
            aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/superuser/dashboard">
                    <i class="fas fa-cash-register fa-fw mr-2 text-gray-400"></i>
                    Dashboard
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
        </div>
        @else
        <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#loginModal">Login</button>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#daftarModal">Daftar</button>

        @endif
        </div>
    </div>

</div>
</nav>


@yield('content')



<!-- Footer -->
<footer class="py-3 border-top">
    <div class="container">
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
    <!-- /.container -->
    </footer>


    <div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="daftarModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="daftarModal">Mendaftar sebagai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-auto">
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/pembeli/daftar')}}" class="btn btn-sm btn-outline-primary text-decoration-none" style="width: 150px">Pembeli</a>
                </div>
                <div class="row d-flex justify-content-center">
                        <h6>atau</h6>
                </div>
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/merchant/daftar')}}" class="btn btn-sm btn-outline-success text-decoration-none" style="width: 150px">Merchant/Penjual</a>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModal">Selamat, berhasil mendaftar !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-auto">
                <div class="row d-flex justify-content-center">
                    <h6>Login sebagai : </h6>
                </div>
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/pembeli/login')}}" class="btn btn-sm btn-outline-primary text-decoration-none" style="width: 150px">Pembeli</a>
                </div>
                <div class="row d-flex justify-content-center">
                        <h6>atau</h6>
                </div>
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/merchant/login')}}" class="btn btn-sm btn-outline-success text-decoration-none" style="width: 150px">Merchant/Penjual</a>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-auto">
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/pembeli/login')}}" class="btn btn-sm btn-outline-primary text-decoration-none" style="width: 150px">Pembeli</a>
                </div>
                <div class="row d-flex justify-content-center">
                        <h6>atau</h6>
                </div>
                <div class="row d-flex justify-content-center">
                    <a href="{{url('/merchant/login')}}" class="btn btn-sm btn-outline-success text-decoration-none" style="width: 150px">Merchant/Penjual</a>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tekan logout untuk konfirmasi.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary">
                    @if (Auth::guard('merchant')->check())
                    <a class="text-decoration-none text-white" href="/merchant/logout">
                        Logout
                    </a>
                    @elseif (Auth::guard('pembeli')->check())
                    <a class="text-decoration-none text-white" href="/pembeli/logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                    @elseif (Auth::guard('superuser')->check())
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

    <div class="modal fade" id="loginStatus" tabindex="-1" aria-labelledby="loginStatus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginStatus">Akun belum diaktivasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-auto">
                <div class="row justify-content-center">
                    <h5 class="" style="width: 150px">Akun merchant belum diaktivasi oleh Admin !</h5>

                </div>
            </div>
            </div>
        </div>
    </div>





    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/jquery-mask/jquery.mask.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

    @if (Session::has('status'))
        <script>
            $(document).ready(function(){
                    $("#statusModal").modal();
            });
        </script>
    @endif

    @if (Session::has('aktivasi'))
        <script>
            $(document).ready(function(){
                $("#loginStatus").modal();
            })
        </script>
    @endif

    <script src="{{asset('js/script.js')}}"></script>

    </body>

    </html>
