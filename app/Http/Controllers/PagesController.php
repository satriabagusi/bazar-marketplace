<?php

namespace App\Http\Controllers;

use App\FotoProduk;
use App\JenisMerchant;
use App\Merchant;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jenisMerchant = JenisMerchant::all();
        $daftarMerchant = Merchant::all()->take(5);
        $produk = Produk::with('foto_produk_sort')->orderBy('updated_at', 'desc')->paginate(16);
        // $produk = array();
        // $produk = Produk::with('foto_produk_sort')->where('id', 93)->get();
        // return $produk;
        return view('index', compact('jenisMerchant', 'produk', 'daftarMerchant'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Produk::with('foto_produk_sort')->where('id_jenis_merchant', $id);
        $produk = $prod->paginate(16);
        $jenisProduk = JenisMerchant::where('id', $id)->get();
        // $produk = Produk::with('foto_produk_sort')->paginate();
        // $produk = Produk::with('foto_produk_sort')->where('id', 139)->get();
        // return $produk;
        return view('produk.filter', compact('produk', 'jenisProduk'));
    }

    public function showMerchant()
    {
        $merchant = Merchant::all();
        return view('produk.daftar-merchant', compact('merchant'));
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

    public function search(Request $request){
        // return $request->all();
        $produk = Produk::with(['foto_produk_sort'])->where('nama_produk', 'like', '%'.$request->produk.'%')->orderBy('created_at', 'desc')->paginate(15);
        $nama_produk = $request->produk;
        // return $produk;
        // return $produk;
        $produk->appends($request->only('produk'));
        return view('produk.cari', compact('produk', 'nama_produk'));
    }

    public function cariMerchant(Request $request){
        $merchant = Merchant::where('nama_merchant', 'like', '%'.$request->merchant.'%')->paginate(15);
        $nama_merchant = $request->merchant;
        // return $merchant;
        return view('produk.cari-merchant', compact('merchant', 'nama_merchant'));
    }
}
