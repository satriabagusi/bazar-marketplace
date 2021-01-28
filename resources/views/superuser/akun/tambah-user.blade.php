@extends('templates.dashboard')
@section('title', 'Tambah Super User')
@section('halaman', 'Tambah Super User')
@section('active', 'active')
@section('tambah-user', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->

<div class="row justify-content-center">
    <div class="col-auto">
        <div class="card shadow mb-4" style="width: 35rem">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Akun Super User</h6>
            </div>
            <div class="card-body px-5">
                <form method="POST" action="/superuser/dashboard/tambah-user" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="username">Username Login</label>
                      <input type="text" class="form-control" id="username" name="username" aria-describedby="username">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="email">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" class="form-control" id="password" aria-describedby="password" min="0">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama Super User</label>
                      <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama" min="0">
                    </div>
                    <div class="form-group">
                      <label for="no_hp_superuser">No HP Super User</label>
                      <input type="tel" name="no_hp_superuser" class="form-control" id="no_hp_superuser" aria-describedby="no_hp_superuser" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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


@endsection
