@extends('templates.dashboard')
@section('title', 'Daftar Transaksi')
@section('halaman', 'Daftar Transaksi')
@section('active', 'active')
@section('riwayat-transaksi', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->

<div class="row mb-5">
    <div class="col">
        <p>Filter Transaksi</p>
        <a href="/pembeli/dashboard/transaksi" class="btn btn-primary">Semua Transaksi</a>
        <a href="/pembeli/dashboard/transaksi/?status=2" class="btn btn-primary">Transaksi Belum Selesai</a>
        <a href="/pembeli/dashboard/transaksi/?status=3" class="btn btn-primary">Transaksi Selesai</a>
    </div>
</div>

    @if (count($transaksi) == 0)
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <h1 class="display-4 text-center">Belum ada Transaksi yang dilakukan</h1>
                        <h5 class="text-center">Yuk, mulai bertransaksi <a class="text-decoration-none" href="/">disini</a></h5>
                        <img class="img-fluid" src="/img/product-not-found.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="row justify-content-center">

        <div class="col-md-10 col-mx-auto">



            @foreach ($transaksi as $item)
            <div class="card shadow-sm mt-4" >
                <div class="card-header bg-white">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <div>
                            <h6>No. Transaksi</h6>
                            <h6><a class="text-decoration-none" href="/pembeli/dashboard/transaksi/detail/{{$item->kode_transaksi}}">{{$item->kode_transaksi}}</a></h6>

                        </div>
                    </div>
                    <div class="col">
                        <div class="">
                            <h6>Status</h6>
                            @if($item->status_transaksi == 0)
                                <h6 class="font-weight-bold">Menunggu pembayaran</h6>
                            @elseif($item->status_transaksi == 1)
                                <h6 class="font-weight-bold">Menunggu pengiriman dari Merchant</h6>
                            @elseif($item->status_transaksi == 2)
                                <h6 class="font-weight-bold">Menunggu Konfirmasi Penerimaan produk</h6>
                            @elseif($item->status_transaksi == 3)
                                <h6 class="font-weight-bold">Transaksi Selesai</h6>
                            @endif
                        </div>
                    </div>
                    <div class="col-4 text-right">
                        <h6><h6>{{date_format($item->created_at, "d M Y")}}</h6></h6>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{url('/gambar-produk/'.$item->foto_produk->url_foto)}}" alt="" class="img-fluid shadow-sm rounded" width="120px">
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">
                                        <a href="/produk/detail/{{$item->id_produk}}" target="_blank" rel="noopener noreferrer" class="text-decoration-none font-weight-bold"><h4>{{ $item->produk->nama_produk}}</h4></a>
                                    </div>
                                    <div class="p-2 bd-highlight">Harga Produk :  <span class="text-info font-weight-bold">Rp {{ number_format($item->produk->harga, 0 , ".", ".")}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex flex-column bd-highlight mb-3">
                            <div class="p-2 bd-highlight">
                                <div >Total Transaksi</div>
                            </div>
                            <div class="p-2 bd-highlight"><span class="text-info font-weight-bold">
                                Rp {{ number_format($item->total_transaksi, 0 , ".", ".")}}</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end ">
                    @if ($item->status_transaksi == 0)
                        <a href="/pembeli/dashboard/transaksi/hapus/{{$item->id}}" class="btn btn-danger mr-2">Batalkan Transaksi</a>
                        <a href="/pembeli/dashboard/transaksi/konfirmasi/{{$item->id}}" class="btn btn-info">Konfirmasi Pembayaran</a>
                        @elseif($item->status_transaksi == 1)
                        <button  href="#" disabled class="btn btn-info">Sudah melakukan pembayaran</button>
                        @elseif($item->status_transaksi == 2)
                        <button id="terima-produk" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#terimaModal" data-id="{{$item->id}}">Terima Produk</button>
                        @elseif($item->status_transaksi == 3)
                        <button  href="#" disabled class="btn btn-info">Transaksi selesai</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>
    </div>

    <div class="row justify-content-around mt-5">

        <div class="col-4">
            Halaman {{$transaksi->currentPage()}}
        </div>
        <div class="col-3">
            Menampilkan {{$transaksi->count()}}
            Dari {{$transaksi->total()}} data
        </div>
        <div class="col-2">
            {{$transaksi->links()}}
        </div>
        </div>



@endif


<div class="modal fade" id="terimaModal" tabindex="-1" aria-labelledby="terimaModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold text-dark" id="terimaModalLabel">Produk sudah diterima ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tekan <span class="badge badge-success">Terima</span> , jika produk sudah diterima. Tekan <span class="badge badge-secondary">Batal</span> jika ingin menutup pesan ini. Pastikan barang yang diterima sesuai dengan pemesanan.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a id="btn-terima" type="submit" class="btn btn-success">Terima</a>
        </div>
      </div>
    </div>
  </div>



@endsection
