@extends('templates.dashboard')
@section('title', 'Daftar Pembeli')
@section('halaman', 'Daftar Pembeli')
@section('active', 'active')
@section('daftar-pembeli', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->

<div class="row">
        <div class="card shadow mb-4" style="width: 100%">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pembeli</h6>
            </div>
            <div class="card-body px-5">
                    @if (count($pembeli) == 0)
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <h5 class=" text-center">Belum ada Pembeli baru yang mendaftar</h5>
                                <img class="img-fluid" src="/img/product-not-found.jpg" alt="">
                            </div>
                        </div>
                    @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>Nama Pembeli</th>
                                <th>Nomer Pekerja</th>
                                <th>No HP Pembeli</th>
                                <th>Bagian</th>
                                <th>Fungsi</th>
                                <th>Alamat</th>
                                <th>Jumlah Poin Pembeli</th>
                                <th>Pengaturan Akun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembeli as $item)
                            <tr>
                                <td>{{$item->nama_pembeli}}</td>
                                <td>{{$item->nomor_pekerja}}</td>
                                <td>{{$item->no_hp_pembeli}}</td>
                                <td>{{$item->bagian}}</td>
                                <td>{{$item->fungsi}}</td>
                                <td>{{$item->alamat}}</td>
                                <td style="text-align: center" class="font-weight-bold">
                                    @if (!$item->point_pembeli)
                                        0
                                    @else
                                        {{$item->point_pembeli}}
                                    @endif
                                </td>
                                <td>
                                    <div class="my-1">
                                        <button id="hapus-pembeli" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusPembeliModal" data-id="{{$item->id}}">Hapus Akun</button>

                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    @endif


                @if (count($pembeli) !== 0)
                <div class="row justify-content-around">

                    <div class="col-4">
                        {{$pembeli->links()}}
                    </div>
                    <div class="col-2">
                        Halaman {{$pembeli->currentPage()}}
                    </div>
                    <div class="col-3">
                        Menampilkan {{$pembeli->count()}}
                        Dari {{$pembeli->total()}} data
                    </div>
                    </div>
                    @endif

            </div>
            </div>
    </div>




    <div class="modal fade" id="hapusPembeliModal" tabindex="-1" aria-labelledby="hapusPembeliModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold text-dark" id="hapusPembeliModalLabel">Ingin hapus Akun Pembeli ini ?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Tekan <span class="badge badge-danger">Hapus</span> , jika ingin menghapus Akun. Tekan <span class="badge badge-secondary">Batal</span> jika tidak ingin menghapus Akun.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="btn-hapus" type="submit" class="btn btn-danger">Hapus</a>
            </div>
          </div>
        </div>
      </div>


@endsection
