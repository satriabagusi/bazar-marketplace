<?php

namespace App\Http\Controllers;

use App\KuponMerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuponMerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('merchant')->check()) {
            $id_merchant = Auth::guard('merchant')->user()->id;
            $kupon_merchant = KuponMerchant::where('id_merchant', $id_merchant)->get();
            // return $kupon_merchant;
            return view('merchant.poin.poin', compact('kupon_merchant'));
        } else {
            return redirect('/');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::guard('merchant')->check()){
            $id_merchant = Auth::guard('merchant')->user()->id;
            $total_voucher = KuponMerchant::where('id_merchant', $id_merchant)->count();
            return view('merchant.poin.tukar-poin', compact('total_voucher'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guard('merchant')->check()) {
            // return $request;

            $kode = sprintf("%03d", rand(1, 200));
            $kode_exist = KuponMerchant::where('kode_voucher', $kode)->first();

            if ($kode_exist) {
                $kode = sprintf("%03d", rand(1, 200));
                DB::transaction(function () use($request, $kode){
                    KuponMerchant::create([
                        'kode_voucher' => $kode,
                        'id_merchant' => $request->id_merchant,
                    ]);
                });

                DB::table('merchant')->decrement('point_merchant', 25);

                return redirect('/merchant/dashboard/poin');
            } else {
                DB::transaction(function () use($request, $kode){
                    KuponMerchant::create([
                        'kode_voucher' => $kode,
                        'id_merchant' => $request->id_merchant,
                    ]);
                });

                DB::table('merchant')->decrement('point_merchant', 25);

                return redirect('/merchant/dashboard/poin');
            }



        } else {
            return redirect('/');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
