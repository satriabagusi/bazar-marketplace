@extends('templates.dashboard')
@section('title', 'Konfirmasi Pengiriman')
@section('halaman', 'Konfirmasi Pengiriman')
@section('active', 'active')
@section('riwayat-transaksi', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->



<div class="row justify-content-center">
        <div class="card shadow mb-4" style="width: 50rem">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Konfirmasi Pengiriman</h6>
            </div>
            <div class="card-body px-5">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-mx-auto">
                        <h5 class="border-bottom">Detail Transaksi  <span class="font-weight-bold">#{{$transaksi->kode_transaksi}}</span> </h5>
                        <div class="d-flex flex-column bd-highlight mb-3">
                            <div class="p-2 bd-highlight">
                                @if (empty($transaksi->foto_produk))
                                    <img class="card-img-top" src="{{url('/gambar-produk/no-image.png')}}" alt=""  class="img-fluid shadow-sm rounded" width="120px"></a>
                                @else
                                    <img src="{{url('/gambar-produk/'.$transaksi->foto_produk->url_foto)}}" alt="" class="img-fluid shadow-sm rounded" width="120px">
                                @endif
                            </div>
                            <div class="p-2 bd-highlight">
                                <p class="font-weight-bold">Nama Pembeli</p>
                                <p>{{$transaksi->pembeli->nama_pembeli}}</p>
                            </div>
                            <div class="p-2 bd-highlight">
                                <p class="font-weight-bold">Nama Produk</p>
                                <p>{{$transaksi->produk->nama_produk}}</p>
                            </div>
                            <div class="p-2 bd-highlight">
                                <p class="font-weight-bold">Total Pembelian Produk</p>
                                <p>{{number_format($transaksi->total_produk, 0, '.', '.')}}</p>
                            </div>
                            <div class="p-2 bd-highlight">
                                <p class="font-weight-bold">Total Transaksi</p>
                                <p>{{number_format($transaksi->total_transaksi, 0, '.', '.')}}</p>
                            </div>
                            <div class="p-2 bd-highlight">
                                <p class="font-weight-bold">Alamat Pengiriman</p>
                                <p>{{$transaksi->pembeli->alamat}}</p>
                            </div>
                            <div class="p-2 bd-highlight">
                                <p class="font-weight-bold">Tanggal Transaksi</p>
                                <p>{{date_format($transaksi->created_at, "d M  Y")}}</p>
                            </div>


                        </div>
                        </div>

                    <div class="col-md-6 col-mx-auto">
                        <form method="POST" action="/pembeli/dashboard/transaksi/konfirmasi" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$transaksi->id}}">
                            <p>Upload Bukti Pengiriman</p>
                            <div class="custom-file">
                                @if ($transaksi->status_transaksi == 2)
                                <label class="custom-file-label" for="customFile">Bukti Pembayaran telah diupload</label>
                                <input type='file' class="custom-file-input" id="imgInp" accept="image/*" disabled />
                                @else
                                <input type='file' class="custom-file-input" id="imgInp" name="bukti_pengiriman" accept="image/*" />
                                <img class="img-fluid rounded shadow-sm my-3" width="120px" id="upload-bukti" />
                                @endif
                                <label class="custom-file-label" for="customFile">Pilih file</label>

                            </div>

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
            <div class="card-footer">
                <div class="d-flex justify-content-end ">
                    @if ($transaksi->status_transaksi == 0)
                    <button type="submit" class="btn btn-outline-primary">Konfirmasi Bayar</button>
                    @elseif($transaksi->status_transaksi == 1)
                    <a href="/merchant/dashboard/transaksi" class="text-decoration-none btn btn-info mr-3" >Kembali</a>
                    <button type="submit" class="btn btn-outline-primary">Konfirmasi Pengiriman</button>
                    @elseif($transaksi->status_transaksi == 2)
                    <a href="/merchant/dashboard/transaksi" class="text-decoration-none btn btn-primary mr-3" >Kembali</a>
                    <button type="button" class="btn btn-info" disabled>Produk sudah Dikirim</button>
                    @endif
                </div>
            </form>

            </div>
        </div>
</div>


@endsection
