@extends('templates.auth')
@section('title', 'Reset Password Akun Pembeli')
@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7 d-none d-lg-block text-center bg-password-image">
                </div>
                <div class="col-lg-5">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Lupa Password</h1>
                        </div>
                        <form class="user" action="{{route('reset-password-pembeli')}}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{$token}}">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                    id="email" name="email" aria-describedby="email"
                                    placeholder="Email" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                            <a href="/" class="btn btn-outline-danger btn-user btn-block">Kembali</a>
                        </form>
                        <p class="small">
                            Sudah Punya akun Pembeli ?
                            <a href="/pembeli/login" class="text-center">Login</a>
                        </p>

                        @if (Session::has('status'))
                        <div class="alert alert-danger mt-2" role="alert">
                            <li>
                                <ul>
                                    {{Session::get('status')}}
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
