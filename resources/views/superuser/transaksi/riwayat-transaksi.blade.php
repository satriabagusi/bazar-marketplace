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
        <a href="/superuser/dashboard/transaksi" class="btn btn-primary">Semua Transaksi</a>
        <a href="/superuser/dashboard/transaksi/?status=1" class="btn btn-primary">Transaksi Belum Selesai</a>
        <a href="/superuser/dashboard/transaksi/?status=2" class="btn btn-primary">Transaksi Selesai</a>
        <a href="/superuser/dashboard/transaksi/?status=3" class="btn btn-primary">Transaksi Ter-verifikasi</a>
    </div>
</div>


@if (Auth::guard('superuser')->user()->id == 1)
<div class="row mb-4 justify-content-end">
    <div class="col-sm-4 col-xs-auto">
        <a href="/superuser/transaksi/export" class="btn btn-sm btn-success rounded"><i class="fas fa-file-download"></i> Export to Excel</a>
    </div>
</div>

@endif



    @if (count($transaksi) == 0)
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h1 class="display-4 text-center">Belum ada Transaksi yang dilakukan</h1>
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
                            <h6><a class="text-decoration-none" href="/superuser/dashboard/transaksi/detail/{{$item->kode_transaksi}}">{{$item->kode_transaksi}}</a></h6>

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
                                    <h6 class="font-weight-bold">Menunggu Konfirmasi Barang diterima Pembeli</h6>
                                @elseif($item->status_transaksi == 3)
                                    <h6 class="font-weight-bold">Transaksi Selesai</h6>
                                @elseif($item->status_transaksi == 4)
                                    <h6 class="font-weight-bold">Transaksi Telah diverifikasi</h6>
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
                                @if (empty($item->foto_produk))
                                    <img class="card-img-top" src="{{url('/gambar-produk/no-image.png')}}" alt=""  class="img-fluid shadow-sm rounded" width="120px"></a>
                                @else
                                    <img src="{{url('/gambar-produk/'.$item->foto_produk->url_foto)}}" alt="" class="img-fluid shadow-sm rounded" width="120px">
                                @endif
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
                        <a href="/superuser/dashboard/transaksi/detail/{{$item->kode_transaksi}}" class="btn btn-sm btn-outline-info mr-2">Detail Transaksi</a>

                </div>
            </div>
        </div>
        @endforeach

    </div>
    </div>

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">
            {{$transaksi->links()}}
        </div>

    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-4 col-xs-auto">
            Halaman {{$transaksi->currentPage()}}
        </div>
        <div class="col-4 col-xs-auto">
            Menampilkan {{$transaksi->count()}}
            Dari {{$transaksi->total()}} data
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
