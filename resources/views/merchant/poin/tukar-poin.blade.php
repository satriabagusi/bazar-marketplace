@extends('templates.dashboard')
@section('title', 'Tukar Poin Merchant')
@section('kupon', 'active')
@section('tukar-poin', 'active')
@section('content')
<!-- Earnings (Monthly) Card Example -->


    <div class="row">
        <div class="col-xs-auto">
            <p class="h5 text-dark">Jumlah Poin dimiliki : <span class="text-primary font-weight-bold">{{Auth::guard('merchant')->user()->point_merchant}}</span></p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xs-auto">
            <p class="h6 text-dark">Tukar Kupon yang di inginkan :</p>

            <div class="row justify-content-center">
                <div class="col-xs-auto col-md-6">
                    <div class="card mb-3 shadow-sm" >
                        <div class="row no-gutters">
                        <div class="col-md-4" style="border-style: none dashed none none; ">
                            <img src="{{url('/img/doorprize.png')}}" class="card-img img-fluid" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h5 class="card-title font-weight-bold">Kupon Undian Doorprize Merchant</h5>
                            <p class="card-text">Kesempatan mendapatkan undian Doorprize dengan Menukar 25 Poin</p>
                            @if (Auth::guard('merchant')->user()->point_merchant < 25)
                                <button disabled class="btn btn-sm btn-primary">Poin tidak mencukupi</button>

                            @else

                                @if ($total_voucher >= 3)
                                    <button disabled class="btn btn-sm btn-danger">Melebihi Batas Klaim Voucher (3 Voucher)</button>
                                @else
                                <form action="/merchant/dashboard/tukar-poin/claim" method="post">
                                    @csrf

                                    <input type="hidden" name="id_merchant" value="{{Auth::guard('merchant')->user()->id}}">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Klaim Voucher</button>
                                </form>
                                @endif

                            @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
