@extends('templates.dashboard')
@section('title', 'Daftar Produk')
@section('halaman', 'Daftar Produk')
@section('active', 'active')
@section('daftar-produk', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->

<div class="row">
    <div class="col-auto">
        <div class="card shadow mb-4" style="width: 100%">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
            </div>
            <div class="card-body px-5">
                    @if (count($produk) == 0)
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <h1 class="display-4 text-center">Belum ada Produk yang ditambahkan</h1>
                                <h5 class="text-center">Yuk, upload produk kamu <a class="text-decoration-none" href="/merchant/dashboard/tambah-produk">disini</a></h5>
                                <img class="img-fluid" src="/img/product-not-found.jpg" alt="">
                            </div>
                        </div>
                    @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
                                <th>Jumlah Stock Produk</th>
                                <th>Foto Produk</th>
                                <th>Deskripsi Produk</th>
                                <th>Pengaturan Akun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                            <tr>
                                <td>{{$item->nama_produk}}</td>
                                <td style="text-align: left">Rp <span class="ml-2" id="hargaproduk">{{number_format($item->harga, 0, '.', '.')}}</span> </td>
                                @if ($item->stock > 0)
                                    @if ($item->stock <10)
                                    <td class="text-danger" style="text-align: center">{{$item->stock}}</td>
                                    @else
                                    <td class="text-success" style="text-align: center">{{$item->stock}}</td>
                                    @endif
                                @else
                                    <td style="text-align: center">Produk tidak tersedia</td>
                                @endif
                                <td style="text-align: center">
                                    @if (count($item->foto_produk) == 0)
                                    <img width="30%"  src="{{url('/gambar-produk/no-image.png')}}" alt="" srcset="">
                                    @else
                                        @foreach ($item->foto_produk as $foto)
                                        <img width="45%"  src="{{url('/gambar-produk/'.$foto->url_foto)}}" alt="" srcset="">
                                        @endforeach
                                    @endif

                                </td>
                                <td>{{substr($item->deskripsi,0,30)}} ...</td>
                                <td>
                                    <div class="my-1">
                                        <a href="/merchant/dashboard/ubah-produk/{{$item->id}}" class="btn btn-sm btn-warning">Ubah Produk</a>
                                    </div>
                                    <div class="my-1">
                                        <button id="hapus-produk" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal" data-id="{{$item->id}}">Hapus Produk</button>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    @endif


                @if (count($produk) !== 0)
                <div class="row justify-content-around">

                    <div class="col-4">
                        Halaman {{$produk->currentPage()}}
                    </div>
                    <div class="col-3">
                        Menampilkan {{$produk->count()}}
                        Dari {{$produk->total()}} data
                    </div>
                    <div class="col-2">
                        {{$produk->links()}}
                    </div>
                    </div>
                    @endif

            </div>
            </div>
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
                <a id="btn-hapus" type="submit" class="btn btn-danger">Hapus</a>
            </div>
          </div>
        </div>
      </div>


@endsection
