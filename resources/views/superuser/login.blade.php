@extends('templates.auth')
@section('title', 'Login Pembeli')
@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Login Superuser</h1>
                        </div>
                        <form class="user" action="{{url('/superuser/login/')}}" method="POST">
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
