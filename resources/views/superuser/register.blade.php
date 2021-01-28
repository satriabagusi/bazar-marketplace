@extends('templates.auth')
@section('title', 'Mendaftar sebagai Pembeli')
@section('content')
    
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <p class="display-4">Bulan K3 2021 Pertamina RU VI</p>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Mendaftar sebagai Pembeli</h1>
                        </div>
                        <form class="user" action="{{route('register-merchant')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="namaLengkap" name="nama_pemilik_merchant"
                                        placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="nama_merchant"
                                        placeholder="Nama merchant">
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control rounded-pill" id="kategoriMerchant" name="id_kategori_merchant">
                                    @foreach ($kategoriMerchant as $item)
                                    <option value="{{$item->id}}">{{$item->nama_kategori_merchant}}</option>
                                    @endforeach
                                </select>
                                </div>
                            <div class="form-group">
                                <div class="mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="username" name="username"
                                        placeholder="Username login">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="password"
                                        id="password" placeholder="Password">
                                        <div class="invalid-feedback" id="error-message-length">
                                            Password kurang dari 4 karakter !
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" name="passwordConfirm"
                                        id="passwordConfirm" placeholder="Confirm password">
                                        <div class="invalid-feedback" id="error-message-confirm">
                                            Password tidak sama
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control form-control-user" id="noHP" name="no_hp_merchant"
                                    placeholder="No HP/Whatsapp">
                            </div>
                            <div class="form-group">
                                <div class="mb-3 mb-sm-0">
                                    <textarea type="text" class="form-control " id="alamat" name="alamat"
                                        placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                            <a href="/" class="btn btn-outline-danger btn-user btn-block">Kembali</a>
                        </form>
                        
                        @if ($errors->any())
                        <div class="alert alert-danger mt-2" role="alert">
                            <ul>
                                {!! implode('', $errors->all('<li>:message</li>')) !!}
                            </ul>   
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection
