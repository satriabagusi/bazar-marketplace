<?php

namespace App\Http\Controllers;

use App\FotoProduk;
use App\JenisMerchant;
use App\Produk;
use App\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('merchant');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('merchant')->check()){
            $id_merchant = Auth::guard('merchant')->user()->id;
            $produk = Produk::with(['foto_produk_sort'])->where('id_merchant', $id_merchant)->paginate(10);
            // return $produk;
            // $produk = [];
            return view('merchant.produk.daftar-produk', compact('produk'));
        }else{
            return redirect('/merchant/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisMerchant = JenisMerchant::get();
        if(Auth::guard('merchant')->check()){
            return view('merchant.produk.tambah-produk', compact('jenisMerchant'));
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
        // return $request->all();
        $id_merchant = Auth::guard('merchant')->user()->id;
        $id_jenis_merchant = Auth::guard('merchant')->user()->id_jenis_merchant;
        $harga = str_replace(".", "", $request['harga']);
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required'
        ]);

        $id_produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'stock' => $request->stock,
            'harga' => $harga,
            'deskripsi' => $request->deskripsi,
            'id_jenis_merchant' => $id_jenis_merchant,
            'id_merchant' => $id_merchant,
        ])->id;

        if($files = $request->file('images')){
            foreach($files as $file){
                $ekstensi = $file->getClientOriginalExtension();
                $name = date("dmYHis").rand(1,100).'.'.$ekstensi;
                $file->move('gambar-produk', $name);
                $images[] = ["url_foto" => $name, "id_produk" => $id_produk, "created_at" => date('Y/m/d H:i:s'), "updated_at" => date('Y/m/d H:i:s')];
            }
        }else{
            $images[] = ["url_foto" => "no-image.png", "id_produk" => $id_produk, "created_at" => date('Y/m/d H:i:s'), "updated_at" => date('Y/m/d H:i:s')];
        }

        DB::table('foto_produk')->insert($images);

        return redirect('/merchant/dashboard/daftar-produk')->with('status', 'Produk '.$request->nama_produk.' berhasil ditambahkan !');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {

        $detailproduk = Produk::with(['merchant_sort'])->where('id', $produk->id_merchant)->get();
        $foto_produk = FotoProduk::where('id_produk', $produk->id)->get();
        // return $foto_produk;
        return view('produk.detail', compact('detailproduk', 'produk', 'foto_produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('merchant.produk.ubah-produk', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {

        $harga = str_replace(".", "", $request['harga']);

        // return $request->all();
        Produk::where('id', $request->id)
        ->update([
            'nama_produk' => $request['nama_produk'],
            'stock' => $request['stock'],
            'harga' => $harga,
            'deskripsi' => $request['deskripsi'],
        ]);

        return redirect("/merchant/dashboard/daftar-produk")->with('status', 'Produk '.$request->nama_produk.' berhasil di update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);
        FotoProduk::destroy('id_produk', $produk->id);
        return back()->with('status', 'Produk '.$produk->nama_produk.' berhasil dihapus !');
    }
}
