@extends('templates.dashboard')
@section('title', 'Detail Transaksi')
@section('halaman', 'Detail Transaksi')
@section('active', 'active')
@section('riwayat-transaksi', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->


    <div class="row justify-content-center">

        <div class="col-md-10 col-mx-auto">

            @foreach ($transaksi as $item)
            <div class="card shadow-sm mt-4" >
                <div class="card-header bg-white">
                    <div class="d-flex flex-column bd-highlight">
                        <div class="p-2 bd-highlight">
                            <h6>No. Transaksi</h6>
                                <h6><a class="text-decoration-none" href="#">{{$item->kode_transaksi}}</a></h6>
                        </div>
                        <div class="p-2 bd-highlight">
                            <h6>Status</h6>
                                @if($item->status_transaksi == 0)
                                    <h6 class="font-weight-bold">Menunggu pembayaran</h6>
                                @elseif($item->status_transaksi == 1)
                                    <h6 class="font-weight-bold">Menunggu pengiriman dari Merchant</h6>
                                @elseif($item->status_transaksi == 2)
                                    <h6 class="font-weight-bold">Transaksi Selesai</h6>
                                @endif
                        </div>
                        <div class="p-2 bd-highlight">
                            <h6>{{date_format($item->created_at, "d M Y")}}</h6>
                        </div>
                      </div>


            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-3">
                        <img src="{{url('/gambar-produk/'.$item->foto_produk->url_foto)}}" alt="" class="img-fluid shadow-sm rounded" width="250px">
                    </div>
                    <div class="col-4">
                        <p>Nama Produk</p>
                        <a href="/produk/detail/{{$item->id_produk}}" target="_blank" rel="noopener noreferrer" class="text-decoration-none font-weight-bold"><h4>{{ $item->produk->nama_produk}}</h4></a>
                    </div>
                    <div class="col border-right ">

                    </div>
                    <div class="col-4">
                        Harga Produk :  <span class="text-info font-weight-bold">Rp {{ number_format($item->produk->harga, 0 , ".", ".")}}
                    </div>
                </div>

                <div class="row mt-5 border-top">
                    <div class="col-12">
                        <p>Pembayaran</p>

                        <div class="row justify-content-between">
                            <div class="col-12">
                                <div class="row justify-content-between  mb-4">
                                    <div class="col-6">
                                        <p>Total Transaksi</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-dark text-right font-weight-bold">Rp {{ number_format($item->total_transaksi, 0 , ".", ".")}}</p>
                                    </div>
                                </div>
                                <div class="row justify-content-between border-bottom mb-4">
                                    <div class="col-8">
                                        <p>Bukti Pembayaran</p>
                                    </div>
                                    <div class="col-4">
                                        <a target="_blank" class="text-decoration-none" href="{{url('/gambar-transfer/'.$item->bukti_transfer)}}">
                                            <img src="{{url('/gambar-transfer/'.$item->bukti_transfer)}}" class="exzoom img-fluid shadow-sm rounded text-right" width="250px" srcset="">
                                            <p>*klik gambar untuk melihat lebih jelas</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-8">
                                        <p>Bukti Pengiriman</p>
                                    </div>
                                    <div class="col-4">
                                        <a target="_blank" class="text-decoration-none" href="{{url('/bukti-pengiriman/'.$item->bukti_pengiriman)}}">
                                            <img src="{{url('/bukti-pengiriman/'.$item->bukti_pengiriman)}}" class="exzoom img-fluid shadow-sm rounded text-right" width="250px" srcset="">
                                            <p>*klik gambar untuk melihat lebih jelas</p>
                                        </a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end ">
                    <a href="/merchant/dashboard/transaksi/" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    </div>









    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold text-dark" id="hapusModalLabel">Ingin hapus produk ?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Tekan <span class="badge badge-danger">Hapus</span> , jika ingin menghapus produk. Tekan <span class="badge badge-secondary">Batal</span> jika tidak ingin menghapus produk.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <form id="form-hapus" action="" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-primary">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>



@endsection
