@extends('templates.auth')
@section('title', 'Login Merchant')
@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-xs-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                        </div>
                        @if ($pembeli)
                        <form class="user" action="{{route('reset')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$pembeli->id}}">

                            <div class="form-group">
                                <input type="username" class="form-control form-control-user"
                                    id="username" name="username" aria-describedby="username"
                                    placeholder="username" autocomplete="off" readonly value="{{$pembeli->username}}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                    id="email" name="email" aria-describedby="email"
                                    placeholder="Email" autocomplete="off" readonly value="{{$pembeli->email}}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user"
                                    id="password" name="password" aria-describedby="password"
                                    placeholder="Masukan Password Baru" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                            <a href="/" class="btn btn-outline-danger btn-user btn-block">Kembali</a>
                        </form>
                        <p class="">
                            Sudah Punya akun Merchant ?
                            <a href="/merchant/login" class="text-center">Login</a>
                        </p>
                        @else
                        <p class="text-center">LINK PASSWORD RESET EXPIRED !</p>
                        <img src="/img/session.png" class="img-fluid" alt="" srcset="">
                        <p class="text-center">
                            Sudah Punya akun Merchant ?
                            <a href="/merchant/login" class="text-center">Login</a>
                        </p>
                        @endif

                        @if (Session::has('error'))
                        <div class="alert alert-danger mt-2" role="alert">
                            <li>
                                <ul>
                                    {{Session::get('error')}}
                                </ul>
                            </li>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger mt-2" role="alert">
                            <li>
                                <ul>
                                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                                </ul>
                            </li>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
