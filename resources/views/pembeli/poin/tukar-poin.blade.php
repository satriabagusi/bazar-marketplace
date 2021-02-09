@extends('templates.dashboard')
@section('title', 'Tukar Poin Pembeli')
@section('kupon', 'active')
@section('tukar-poin', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->


    <div class="row">
        <div class="col-xs-auto">
            <p class="h5 text-dark">Jumlah Poin dimiliki : <span class="text-primary font-weight-bold">{{Auth::guard('pembeli')->user()->point_pembeli}}</span></p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xs-auto">
            <p class="h6 text-dark">Tukar Kupon yang di inginkan :</p>

            <div class="row justify-content-center">
                @foreach ($jeniskupon as $item)
                <div class="col-xs-auto col-md-6">
                    <div class="card mb-3 shadow-sm" >
                        <div class="row no-gutters">
                        <div class="col-md-4" style="border-style: none dashed none none">
                            <img src="{{url('/img/doorprize.png')}}" class="card-img img-fluid" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h5 class="card-title font-weight-bold">Kupon Undian {{$item->deskripsi}}</h5>
                            <p class="card-text">Tukar <span class="font-weight-bold">{{$item->poin}}</span> POIN untuk klaim kupon Doorprize</p>
                            <p class="card-text">Kesempatan mendapatkan undian {{$item->deskripsi}}</p>
                            @if (Auth::guard('pembeli')->user()->point_pembeli < $item->poin)
                                <button disabled class="btn btn-sm btn-primary">Poin tidak mencukupi</button>

                            @else
                                <form action="/pembeli/dashboard/tukar-poin/claim" method="post">
                                    @csrf

                                    <input type="hidden" name="id_pembeli" value="{{Auth::guard('pembeli')->user()->id}}">
                                    <input type="hidden" name="id_jenis_kupon" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Klaim Voucher</button>
                                </form>

                            @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
