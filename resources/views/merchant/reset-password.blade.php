@extends('templates.auth')
@section('title', 'Login Merchant')
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
                            <input type="hidden" name="token" value="{{$merchant->token}}">
                            <p>Link Reset Password sudah dikirim ke </p>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                    id="email" name="email" aria-describedby="email"
                                    placeholder="Email" autocomplete="off" readonly value="{{$merchant->email}}">
                            </div>
                            <p>Klik link yang tertera pada email untuk melakukan reset password</p>
                        <p class="small">
                            Sudah Punya akun Merchant ?
                            <a href="/merchant/login" class="text-center">Login</a>
                        </p>

                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
