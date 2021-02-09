<?php

namespace App\Http\Controllers;

use App\JenisKuponPembeli;
use App\KuponPembeli;
use App\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuponPembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('pembeli')->check()){
            $id_pembeli = Auth::guard('pembeli')->user()->id;
            $kupon_pembeli = KuponPembeli::where('id_pembeli', $id_pembeli)->paginate(9);
            // return $kupon_pembeli;
            return view('pembeli.poin.poin', compact('kupon_pembeli'));
        }elseif(Auth::guard('merchant')->check()){
            return view('merchant.poin.poin');
        }else{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guard('pembeli')->check()) {
            // return $request->id_jenis_kupon;
            $kode = sprintf("%03d", rand(1, 500));
            $kode_exist = KuponPembeli::where('kode_kupon', $kode)->first();
            $poin_kupon = JenisKuponPembeli::select('poin')->find($request->id_jenis_kupon)->poin;

            if ($kode_exist) {
                $kode = sprintf("%03d", rand(1, 500));

                DB::transaction(function () use($kode, $request, $poin_kupon) {
                    KuponPembeli::create([
                        'kode_kupon' => $kode,
                        'id_pembeli' => $request->id_pembeli,
                        'id_jenis_kupon' => $request->id_jenis_kupon,
                    ]);

                    DB::table('pembeli')->decrement('point_pembeli', $poin_kupon);

                });

                return redirect('/pembeli/dashboard/poin');

            } else {

                DB::transaction(function () use($kode, $request, $poin_kupon) {
                    KuponPembeli::create([
                        'kode_kupon' => $kode,
                        'id_pembeli' => $request->id_pembeli,
                        'id_jenis_kupon' => $request->id_jenis_kupon,
                    ]);

                    DB::table('pembeli')->decrement('point_pembeli', $poin_kupon);
                });
                return redirect('/pembeli/dashboard/poin');
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
