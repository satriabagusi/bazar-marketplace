@extends('templates.dashboard')
@section('title', 'Daftar Merchant')
@section('halaman', 'Daftar Merchant')
@section('active', 'active')
@section('aktivasi', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->

<div class="row">
        <div class="card shadow mb-4" style="width: 100%">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Merchant</h6>
            </div>
            <div class="card-body px-5">
                    @if (count($merchant) == 0)
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <h5 class=" text-center">Belum ada Merchant baru yang mendaftar / akun Merchant sudah teraktivasi semua</h5>
                                <img class="img-fluid" src="/img/product-not-found.jpg" alt="">
                            </div>
                        </div>
                    @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>Nama Merchant</th>
                                <th>Nama Pemilik Merchant</th>
                                <th>No HP Merchant</th>
                                <th>Status Merchant</th>
                                <th>Kategori Merchant</th>
                                <th>Jenis Merchant</th>
                                <th>Pengaturan Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merchant as $item)
                            <tr>
                                <td>{{$item->nama_merchant}}</td>
                                <td>{{$item->nama_pemilik_merchant}}</td>
                                <td>{{$item->no_hp_merchant}}</td>
                                <td>
                                    @if ($item->acc_status > 0)
                                        <p>Akun sudah diaktivasi</p>
                                    @else
                                        <p>Akun belum diaktivasi</p>
                                    @endif
                                </td>
                                <td>{{$item->kategori_merchant->nama_kategori_merchant}}</td>
                                <td>{{$item->jenis_merchant->nama_jenis_merchant}}</td>
                                <td style="text-align: center">
                                    <button id="hapus-produk" type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#aktivasiModal" data-id="{{$item->id}}">Aktifkan Akun</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    @endif


                @if (count($merchant) !== 0)
                <div class="row justify-content-around">

                    <div class="col-4">
                        Halaman {{$merchant->currentPage()}}
                    </div>
                    <div class="col-3">
                        Menampilkan {{$merchant->count()}}
                        Dari {{$merchant->total()}} data
                    </div>
                    <div class="col-2">
                        {{$merchant->links()}}
                    </div>
                    </div>
                    @endif

            </div>
            </div>
    </div>

    <div class="modal fade" id="aktivasiModal" tabindex="-1" aria-labelledby="aktivasiModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold text-dark" id="aktivasiModalLabel">Aktifkan Merchant ini?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Tekan <span class="badge badge-info">Aktifkan</span> , jika ingin mengaktifkan Akun Merchant ini. Tekan <span class="badge badge-secondary">Batal</span> jika tidak ingin mengaktifkan akun.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="btn-aktivasi" type="submit" class="btn btn-info">Aktifkan</a>
            </div>
          </div>
        </div>
      </div>


@endsection
