@extends('templates.auth')
@section('title', 'Login Merchant')
@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7 d-none d-lg-block text-center bg-login-image-merchant">
                </div>
                <div class="col-lg-5">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Login sebagai Merchant</h1>
                        </div>
                        <form class="user" action="{{route('login-merchant')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                    id="username" name="username" aria-describedby="username"
                                    placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user"
                                    id="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                            <a href="/" class="btn btn-outline-danger btn-user btn-block">Kembali</a>
                        </form>
                        <p class="small">
                            Lupa password akun Merchant ?
                            <a href="/merchant/lupa-password" class="text-center">Reset Password</a>
                        </p>

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
