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
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">



</head>

<body class="bg-gradient-primary">

    @yield('content')

    <footer class="py-3 border-top bg-white">
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



    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/jquery-mask/jquery.mask.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.js')}}"></script>

    <script src="{{asset('js/script.js')}}"></script>

</body>

</html>
