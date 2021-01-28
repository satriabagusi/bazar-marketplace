@extends('templates.home')
@section('title', 'Bazar Bulan K3 2021')

@section('content')
<!-- Page Content -->
<div class="container">

    <div class="row mt-4">
        <div class="col-lg-8">
            <span class="my-4">
                <span><a href="/" class="btn btn-primary rounded-circle"><i class="fas fa-arrow-left"></i></a></span>
                <span class="">Menampilkan hasil filter </span>
                <span class="text-italic font-weight-bold">"{{$jenisProduk[0]->nama_jenis_merchant}}"</span>
            </span>
            {{-- <div class="list-group">
                @foreach ($jenisMerchant as $item)
                <a href="/produk/filter/kategori/id={{$item->id}}" class="list-group-item text-decoration-none" >{{$item->nama_jenis_merchant}}</a>
                @endforeach --}}
            </div>
    </div>

        <div class="row mt-3">



            </div>
        <!-- /.col-lg-3 -->

        {{-- <div class="col-lg-9"> --}}


    @if (count($produk) == 0)
    <div class="row justify-content-center my-5">
        <div class="col-auto">
            <img class="img-fluid" width="450px" src="/img/product-not-found.jpg" alt="">
            <p class="text-secondary text-center">Belum ada produk terdaftar</p>
            <h5 class="text-center">Mari menjadi bagian Bazar bulan K3 sebagai merchant !</h5>
            <h6 class="text-center">Klik <a class="text-decoration-none" href="/merchant/daftar">Disini </a>untuk mendaftar</h6>
            </div>
        </div>
        @else
        <div class="row">
            @foreach ($produk as $item)
            {{-- {{ $item->Foto_produk->url_foto }} --}}
            <div class="col-lg-3 col-md-4 mb-4">
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
        @endif

        @if (count($produk) !== 0)
        <div class="mt-3 row text-center justify-content-center">
            <div class="col-10">
                <p class=" text-muted">
                    Jumlah Produk yang ditampilkan {{ $produk->total() }} dari {{ $produk->perPage() }} per halaman
                </p>


                {{ $produk->links() }}
            </div>
        </div>
        @endif


        <!-- /.row -->

    {{-- </div> --}}
    <!-- /.col-lg-9 -->

</div>
<!-- /.row -->

</div>
<!-- /.container -->
@endsection
