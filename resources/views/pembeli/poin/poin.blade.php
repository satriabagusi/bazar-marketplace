@extends('templates.dashboard')
@section('title', 'Tukar Poin Pembeli')
@section('kupon', 'active')
@section('daftar-kupon', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->


    <div class="row">
        <div class="col-xs-auto">
            <p class="h5 text-dark">Jumlah Poin dimiliki : <span class="text-primary font-weight-bold">{{Auth::guard('pembeli')->user()->point_pembeli}}</span></p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xs-auto col-md-12">
            <p class="h6 text-dark">Kupon dimiliki :</p>

            <div class="row">
                @foreach ($kupon_pembeli as $item)
                <div class="col-xs-auto col-md-4">
                    <div class="card mb-3 shadow-sm" style="max-width: 540px;">
                        <div class="row no-gutters">
                          <div class="col-md-4" style="border-style: none dashed none none">
                            <img src="{{url('/img/doorprize.png')}}" class="card-img" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title font-weight-bold">Kupon Undian {{$item->jenis_kupon_pembeli->deskripsi}}</h5>
                              <p class="card-text">Kesempatan mendapatkan undian {{$item->jenis_kupon_pembeli->deskripsi}} dengan Menukar {{$item->jenis_kupon_pembeli->poin}} Poin</p>
                              <p class="card-text "> Nomor Undian : <span class="font-weight-bold text-primary">{{$item->kode_kupon}}</span></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                @endforeach
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-xs-auto col-md-4">{{$kupon_pembeli->links()}}</div>
                <div class="col-xs-auto col-md-4">Data ditampilkan {{$kupon_pembeli->perPage()}} per halaman dari {{$kupon_pembeli->total()}} total data</div>
            </div>

        </div>
    </div>
@endsection
