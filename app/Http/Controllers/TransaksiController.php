<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Pembeli;
use App\Produk;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function search(Request $request){
        if (Auth::guard('merchant')->check()) {
            $id_merchant = Auth::guard('merchant')->user()->id;
            $transaksi = Transaksi::where('id_merchant', $id_merchant)->where('kode_transaksi', $request->s)->get();
            return $transaksi;
        }elseif(Auth::guard('superuser')->check()){
            $transaksi = Transaksi::all()->where('kode_transaksi', $request->s)->orderBy('created_at', 'asc')->get();
            return $transaksi;
        }else{
            return redirect('/');
        }
     }

    public function index(Request $request)
    {
        // return $request->all();

        if (Auth::guard('merchant')->check()) {
            if($request->status == 2){
                $id_merchant = Auth::guard('merchant')->user()->id;
                $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_merchant', $id_merchant)->where('status_transaksi', '=', 3)->orderBy('created_at', 'desc')->paginate(10);
                // return $transaksi;
                return view('merchant.transaksi.riwayat-transaksi', compact('transaksi'));
            }elseif($request->status == 1){
                $id_merchant = Auth::guard('merchant')->user()->id;
                $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_merchant', $id_merchant)->where('status_transaksi', '<', 3)->orderBy('created_at', 'desc')->paginate(10);
                // return $transaksi;
                return view('merchant.transaksi.riwayat-transaksi', compact('transaksi'));
            }else{
                $id_merchant = Auth::guard('merchant')->user()->id;
                $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_merchant', $id_merchant)->orderBy('created_at', 'desc')->paginate(10);
                // return $transaksi;
                return view('merchant.transaksi.riwayat-transaksi', compact('transaksi'));
            }
        } elseif(Auth::guard('pembeli')->check()) {
            if($request->status == 2){
                $id_pembeli = Auth::guard('pembeli')->user()->id;
                $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_pembeli', $id_pembeli)->where('status_transaksi', '=', 3)->orderBy('created_at', 'desc')->paginate(10);
                // return $transaksi;
                return view('pembeli.transaksi.riwayat-transaksi', compact('transaksi'));
            }elseif($request->status == 1 ){
                $id_pembeli = Auth::guard('pembeli')->user()->id;
                $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_pembeli', $id_pembeli)->where('status_transaksi', '<', 3)->orderBy('created_at', 'desc')->paginate(10);
                // return $transaksi;
                return view('pembeli.transaksi.riwayat-transaksi', compact('transaksi'));
            }else{
                $id_pembeli = Auth::guard('pembeli')->user()->id;
                $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_pembeli', $id_pembeli)->orderBy('created_at', 'desc')->paginate(10);
                // return $transaksi;
                return view('pembeli.transaksi.riwayat-transaksi', compact('transaksi'));
            }
        } elseif(Auth::guard('superuser')->check()){
            if($request->status == 2){
                $transaksi = Transaksi::orderBy('created_at', 'desc')->where('status_transaksi', '=', 3)->paginate(10);
            return view('superuser.transaksi.riwayat-transaksi', compact('transaksi'));
            }elseif($request->status == 1 ){
                $transaksi = Transaksi::orderBy('created_at', 'desc')->where('status_transaksi', '<', 3)->paginate(10);
                return view('superuser.transaksi.riwayat-transaksi', compact('transaksi'));
            }else{
                $transaksi = Transaksi::orderBy('created_at', 'desc')->paginate(10);
            return view('superuser.transaksi.riwayat-transaksi', compact('transaksi'));
            }

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

        if(Auth::guard('pembeli')->check()){
            // return $request->all();
        $produk = Produk::select('nama_produk')->where('id', $request->id)->first();
        $merchant = Merchant::select('nama_merchant','no_hp_merchant')->where('id', $request->id_merchant)->first();

        // KODE TRANSAKSI
        $date = date('dmY');
        $chekTransaction = Transaksi::all()->first();
        if(count((array)$chekTransaction) > 0){
            $get_id = Transaksi::select('id')->get()->last()->id + 1;
        }else{
            $get_id = 1;
        }
        $id = "00".$get_id;
        if($get_id > 9){
            if ($get_id <= 99 ) {
                $id = substr($id, 1);
            }elseif ($get_id <= 999) {
                $id = substr($id, 2);
            }elseif ($get_id <= 9999) {
                $id = substr($id, 3);
            }elseif($get_id > 9999){
                $id = $get_id;
            }
        }
        $no_transaksi =  $date.$id ;
        $total = str_replace(".", "", $request['total_transaksi']);
        // return floor($total/5000);

        $merchant = Merchant::find($request->id_merchant);
        DB::transaction(function() use($request, $no_transaksi, $produk, $merchant, $total) {

            Transaksi::create([
                'kode_transaksi' => $no_transaksi,
                'pesan' => $request->pesan,
                'status_transaksi' => 0,
                'total_produk' => $request->total_produk,
                'total_transaksi' => $total,
                'id_produk' => $request->id_produk,
                'id_pembeli' => $request->id_pembeli,
                'id_merchant' => $request->id_merchant
            ]);

            $produk = Produk::find($request->id_produk);
            $produk->stock = $produk->stock - $request->total_produk;
            $produk->save();

        });

        return redirect()->away('https://api.whatsapp.com/send?phone='.substr_replace($merchant->no_hp_merchant, '62',0,1).'&text=Halo%20*'.$merchant->nama_merchant.'*%2C%20saya%20tertarik%20membeli%20produk%20*'.$produk->nama_produk.'*');

    }else{
        return redirect('/');
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        if (Auth::guard('merchant')->check()) {
            $id_merchant = Auth::guard('merchant')->user()->id;
            $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_merchant', $id_merchant)->orderBy('created_at', 'desc')->paginate(10);
            return view('merchant.transaksi.riwayat-transaksi', compact('transaksi'));
        } elseif(Auth::guard('pembeli')->check()) {
            $id_pembeli = Auth::guard('pembeli')->user()->id;
            $transaksi = Transaksi::with(['foto_produk', 'produk'])->where('id_pembeli', $id_pembeli)->orderBy('created_at', 'desc')->paginate(10);
            // return $transaksi;
            return view('pembeli.transaksi.riwayat-transaksi', compact('transaksi'));
        } elseif(Auth::guard('superuser')->check()){
            $transaksi = Transaksi::all()->orderBy('created_at', 'desc');
            return $transaksi;
        }else{
            return redirect('/');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        if (Auth::guard('merchant')->check()) {
            return view('merchant.transaksi.konfirmasi', compact('transaksi'));
        } elseif(Auth::guard('pembeli')->check()) {
            return view('pembeli.transaksi.konfirmasi', compact('transaksi'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {


        if(Auth::guard('merchant')->check()){
            $request->validate([
                'bukti_pengiriman' => 'required|image|mimes:jpeg,png,jpg,svg',
            ]);

            if ($request->hasFile('bukti_pengiriman')) {
                $image = $request->file('bukti_pengiriman');
                $name = date("dmYHis").'.'.$image->getClientOriginalExtension();
                $image->move('bukti-pengiriman', $name);
                // return $name;
            }

            DB::transaction(function() use($request, $name) {
                Transaksi::where('id', $request->id)->update([
                'status_transaksi' => 2,
                'bukti_pengiriman' => $name,
                ]);
            });

            return back()->with('status','Berhasil upload bukti pengiriman');

        }elseif(Auth::guard('pembeli')->check()){
            $status = Transaksi::select('status_transaksi')->where('id', $request->id)->get();

            if($status == 0){
                $request->validate([
                    'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,svg',
                ]);

                if ($request->hasFile('bukti_transfer')) {
                    $image = $request->file('bukti_transfer');
                    $name = date("dmYHis").'.'.$image->getClientOriginalExtension();
                    $image->move('gambar-transfer', $name);
                    // return $name;
                }

                DB::transaction(function() use($request, $name) {

                Transaksi::where('id', $request->id)
                ->update([
                    'status_transaksi' => 1,
                    'bukti_transfer' => $name,
                    ]);

                });

                return back()->with('status','Berhasil upload bukti pembayaran');

                }


        }else{
            return redirect('/');
        }

    }


        /**
         * Remove the specified resource from storage.
         *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        if(Auth::guard('merchant')->check()){
            Transaksi::destroy($transaksi->id);
            $produk = Produk::where('id', $transaksi->id_produk)->first();
            Produk::where('id', $transaksi->id_produk)->update([
                'stock' => $produk->stock + $transaksi->total_produk,
            ]);

            return back()->with('status', 'Pesanan '.$transaksi->kode_transaksi.' dibatalkan');
        }elseif(Auth::guard('pembeli')->check()){
            Transaksi::destroy($transaksi->id);
            $produk = Produk::where('id', $transaksi->id_produk)->first();
            Produk::where('id', $transaksi->id_produk)->update([
                'stock' => $produk->stock + $transaksi->total_produk,
            ]);
            return back()->with('status', 'Pesanan '.$transaksi->kode_transaksi.' dibatalkan');
        }else{
            return redirect('/');
        }
        // return $transaksi;
    }

    public function terimaBarang(Transaksi $transaksi){
        // return $transaksi;


        if(Auth::guard('pembeli')->check()){
            DB::transaction(function() use($transaksi) {
                Transaksi::where('id', $transaksi->id)
                ->update([
                    'status_transaksi' => 3,
                ]);

            });

            return back()->with('status', 'Barang telah diterima!');
        }

    }

    public function detailTransaksi($kode_transaksi){
        $transaksi =  Transaksi::where('kode_transaksi', $kode_transaksi)->get();
        // return $transaksi->kode_transaksi;
        if(Auth::guard('merchant')->check()){
            $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)->get();
            return view('merchant.transaksi.detail-transaksi', compact('transaksi'));

        }elseif(Auth::guard('pembeli')->check()){
            $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)->get();
            return view('pembeli.transaksi.detail-transaksi', compact('transaksi'));

        }elseif(Auth::guard('superuser')->check()){
            $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)->get();
            return view('superuser.transaksi.detail-transaksi', compact('transaksi'));
        }else{
            return redirect('/');
        }

    }
}