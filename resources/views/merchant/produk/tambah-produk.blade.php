@extends('templates.dashboard')
@section('title', 'Tambah Produk')
@section('halaman', 'Tambah Produk')
@section('active', 'active')
@section('tambah-produk', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->

<div class="row">
    <div class="col-auto">
        <div class="card shadow mb-4" style="width: 35rem">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
            </div>
            <div class="card-body px-5">
                <form method="POST" action="/merchant/dashboard/tambah-produk" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="nama-produk">Nama Produk</label>
                      <input type="text" class="form-control" id="nama-produk" name="nama_produk" aria-describedby="namaproduk">
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" class="form-control" id="stock" aria-describedby="stock" min="0" value="1">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="hargaproduk">Harga</label>
                      <input type="text" name="harga" class="form-control" id="hargaproduk" aria-describedby="hargaproduk" min="0">
                    </div>
                    <div class="form-group">
                      <label for="deskripsi-produk">Deskripsi Produk</label>
                      <textarea name="deskripsi" class="form-control" id="deskripsi-produk" aria-describedby="deskripsi-produk"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Foto Produk</label>
                        <div class="input-images"></div>
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