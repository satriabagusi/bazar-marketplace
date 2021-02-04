@extends('templates.dashboard')
@section('title', 'Dashboard Merchant')
@section('content')
<!-- Earnings (Monthly) Card Example -->
<div class="row justify-content-center">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Transaksi </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transaksi_count}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
        </div>
    </div>
</div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Seluruh Transaksi Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{number_format($total_transaksi, 0, 0, '.')}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
        </div>
    </div>
</div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Transaksi Selesai belum Ter-verifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transaksi_selesai}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
        </div>
    </div>
</div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Transaksi Ter-verifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transaksi_verifikasi}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
        </div>
    </div>
</div>

</div>
@endsection
