@extends('templates.home')
@section('title', 'Bazar Bulan K3 2021')

@section('content')
<!-- Page Content -->
<div class="container">

<div class="row my-5">

  <div class="col-5 col-mx-auto">

    <div id="fotoProduk" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner shadow rounded-lg">
            <div class="carousel-inner">
                @if (empty($foto_produk))
                <img class="card-img-top" src="{{url('/gambar-produk/no-image.png')}}" alt=""  style="width: 700; height: 400;">

                @else
                @foreach($foto_produk as $key => $foto)
                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                    <img src="{{url('/gambar-produk/'.$foto->url_foto)}}" class="d-block w-100"  alt="...">
                </div>
                @endforeach
                @endif
            </div>
            {{-- @foreach ($foto_produk as $item)
                <div class="carousel-item active">
                <img id="preview-produk" src="{{url('/gambar-produk/'.$item->url_foto)}}" class=" img-fluid d-block " alt="...">
                </div>
            @endforeach --}}

          </div>
        <a class="carousel-control-prev" href="#fotoProduk" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#fotoProduk" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
      </div>
</div>

    {{-- <div class="border-right mx-3">

    </div> --}}

    <div class="col-6 ml-5">

            <div class="d-flex flex-column">
                <div class="my-1">
                    <h1 class="">{{$produk->nama_produk}}</h1>
                </div>
                <div class="my-1">
                    <h5 class="text-primary font-weight-bold">Rp{{number_format($produk->harga, 0, '.', '.')}}</h5>                
		</div>
                <div class="my-1">
                    @if ($produk->stock > 0)
                    <h5 >Stock : <span class="font-weight-bold" id="stock">{{$produk->stock}}</span></h5>
                    @else
                    <h5 >Stock : <span class="badge badge-danger font-weight-bold">Habis</span></h5>
                    @endif
                </div>


                @if (Auth::guard('pembeli')->check())
                @if ($produk->stock > 0)
                <form action="/transaksi/beli/{{$produk->id}}" method="POST">
                  @csrf
                  <input type="hidden" name="id_produk" value="{{$produk->id}}">
                  <input type="hidden" name="id_pembeli" value="{{Auth::guard('pembeli')->user()->id}}">
                  <input type="hidden" name="id_merchant" value="{{$produk->id_merchant}}">

                    <label for="jumlahPesanan">Jumlah Pesanan</label>
                    <div class="form-group form-inline">
                        <input style="width: 120px" type="number" name="total_produk" class="form-control mr-2" id="jumlahPesanan" min="1" value="1">
                        <button type="button" id="tambah_stock" class="btn btn-sm btn-primary rounded-circle mr-2" ><i class="fas fa-plus"></i></button>
                        <button type="button" id="kurangi_stock" class="btn btn-sm btn-danger rounded-circle mr-2" readonly><i class="fas fa-minus"></i></button>
                      </div>

                      <div style="width: 200px;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                          </div>
                          <input disabled type="text" class="form-control" id="total_transaksi" name="total_transaksi" placeholder="Total Transaksi" value="{{$produk->harga}}">
                        </div>
                    </div>

                    <div class="form-group mt-4">
                      <textarea class="form-control" placeholder="Catatan Pembelian" name="pesan"></textarea>
                    </div>

                    <div class=" mt-3">
                      <p class="text-muted mt-5">*Pastikan jumlah pesanan sesuai, setiap tombol pesan ditekan maka langsung tercatat sebagai pembelian</p>
                    </div>
                    <div class="">
                      <button type="submit" class="btn btn-primary mt-4"> Pesan via WhatsApp</button>
                    </div>


                    {{-- <a target="_blank" href="{{'https://api.whatsapp.com/send?phone='.str_replace("0","62",$detail_produk[0]->no_hp_merchant).'&text=Halo%20*'.$detail_produk[0]->nama_merchant.'*%2C%20saya%20tertarik%20membeli%20produk%20*'.$detailproduk->nama_produk.'*'}}" class="btn btn-success"><i class="fab fa-whatsapp"></i> Hubungi Merchant via WhatsApp</a> --}}
                    </form>
                    @else
                    <button type="submit" class="btn btn-danger mt-4" disabled><i class="fab fa-whatsapp"></i> Produk tidak tersedia</button>
                    @endif
                    @elseif(Auth::guard('merchant')->check())
                        <button class="btn btn-info mt-4" data-toggle="modal" disabled>Login sebagai Pembeli untuk melakukan transaksi</button>
                    @else
                        <button class="btn btn-success mt-3" data-toggle="modal" data-target="#loginModal"><i class="fab fa-whatsapp"></i> Hubungi Merchant via WhatsApp</button>
                    @endif


            </div>
    </div>
</div>
<div class="row">
  <div class="col">
    <div class="p-2 mt-4 border-top">
      <h4 class="">Deskripsi Produk</h4>
      <div class="row my-5">
          <div class="col-md-6 col-xs-auto">
              <p class="text-muted border-bottom">Produk Dijual Oleh</p>
          </div>
          <div class="col-md-6 col-xs-auto">
              <p class="">{{$produk->merchant_sort->nama_merchant}}</p>
          </div>
      </div>
      <div class="row my-5">
          <div class="col-md-6 col-xs-auto">
              <p class="text-muted border-bottom">Produk Dijual Oleh</p>
          </div>
          <div class="col-md-6 col-xs-auto">
            <textarea class="form-control" style="width: 100%!important;background-color:transparent; border: none; overflow: auto; outline: none; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; resize: none"
            @if (strlen($produk->deskripsi) > 550)
            rows="30"
            @else
            rows="15"
            @endif
            readonly> {{$produk->deskripsi}} </textarea>
          </div>
      </div>
    </div>
  </div>
</div>
</div>

</div>
<!-- /.container -->
@endsection
