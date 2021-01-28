@extends('templates.home')
@section('title', 'Bazar Bulan K3 2021')

@section('content')
<!-- Page Content -->
<div class="container">

    <div class="row my-4">
        <div class="col-md-12 col-xs-auto">
            <div class="card mb-3 border-0" style="">
                <div class="row no-gutters">
                  <div class="col-md-4 py-5 px-5">
                    <img src="/img/seller.png" class="card-img img-fluid border" style="width: 250px!important">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body my-4">
                      <h5 class="card-title">{{$merchant->nama_merchant}}</h5>
                      <p class="card-text">Menjual {{$merchant->jenis_merchant->nama_jenis_merchant}}</p>
                      <p class="card-text"><small class="text-muted"> Merchant dibuat tanggal : {{date_format($merchant->created_at, ('d M Y'))}}</small></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-12 col-xs-auto">
            <div class="card text-center border-0">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#">Produk</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($produk as $item)
                        {{-- {{ $item->Foto_produk->url_foto }} --}}
                        <div class="col-xs-3 col-md-3 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img class="card-img-top" src="{{url('/gambar-produk/'.$item->foto_produk_sort->url_foto)}}" alt=""  style="width: 700; height: 400;"></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="/produk/detail/{{$item->id}}">{{$item->nama_produk}}</a>
                                    </h4>
                                    <h5>Rp. <span >{{number_format($item->harga, 0, ".", ".")}}</span></h5>
                                    <p class="card-text text-truncate">{{$item->deskripsi}}</p>
                                    <a class="stretched-link" href="/produk/detail/{{$item->id}}"></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
              </div>
        </div>

    </div>



</div>
<!-- /.container -->
@endsection
