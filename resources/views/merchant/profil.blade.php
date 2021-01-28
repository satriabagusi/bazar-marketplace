@extends('templates.home')
@section('title', 'Bazar Bulan K3 2021')
@section('content')
    

<!-- Page Content -->
<div class="container">
    
    <div class="row my-5">
        
        <div class="col-lg-3">
            
            <h3 class="my-4">Kategori produk</h3>
            <div class="list-group">
                @foreach ($jenisMerchant as $item)
                <a href="" class="list-group-item text-decoration-none" >{{$item->nama_jenis_merchant}}</a>
                @endforeach
            </div>
            
        </div>
        <!-- /.col-lg-3 -->
        
        <div class="col-lg-9">
            
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="{{asset('/img/banner1.jpg')}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="{{asset('/img/banner2.jpg')}}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid" src="{{asset('/img/banner3.jpg')}}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
    
    
    @if (count($produk) == 0)
    <div class="row justify-content-center my-5">
        <div class="col-4">
            <span class="text-secondary">Belum ada produk terdaftar</span>
            </div>
        </div>
        @else
        <div class="row">
            @foreach ($produk as $item)
            {{-- {{ $item->Foto_produk->url_foto }} --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    @foreach ($item->foto_produk as $foto)
                    <img class="card-img-top" src="{{url('/gambar-produk/'.$foto->url_foto)}}" alt=""  style="width: 700; height: 400;"></a>
                    @endforeach
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="/produk/detail/{{$item->id}}">{{$item->nama_produk}}</a>
                        </h4>
                        <h5>Rp. <span >{{number_format($item->harga, 0, ".", ".")}}</span></h5>
                        <p class="card-text">{{$item->deskripsi}}</p>
                        <a class="stretched-link" href="/produk/detail/{{$item->id}}"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <div class="mt-3 row text-center justify-content-center">
            <div class="col-10">
                <p class=" text-muted">
                    Jumlah Produk yang ditampilkan {{ $produk->total() }} dari {{ $produk->perPage() }} per halaman
                </p>
                
                
                {{ $produk->links() }}
            </div>
        </div>
        
        
        <!-- /.row -->
        
    </div>
    <!-- /.col-lg-9 -->
    
</div>
<!-- /.row -->

</div>
<!-- /.container -->

@endsection