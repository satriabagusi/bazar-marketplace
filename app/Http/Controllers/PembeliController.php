<?php

namespace App\Http\Controllers;

use App\KategoriPembeli;
use App\Pembeli;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembeliController extends Controller
{
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('pembeli');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriPembeli = KategoriPembeli::get();
        return view('pembeli.register', compact('kategoriPembeli'));
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
        $request->validate([
            'nama_pembeli' => 'required|string',
            'username' => 'required',
            'nomor_pekerja' => 'required|unique:pembeli',
            'fungsi' => 'required',
            'bagian' => 'required',
            'id_kategori_pembeli' => 'min:1|not_in:0',
            'email' => 'required',
            'password' => 'min:4|required|confirmed',
            'no_hp_pembeli' => 'required',
            'alamat' => 'required'
        ]);

        Pembeli::create([
            'nama_pembeli' => $request->nama_pembeli,
            'username' => $request->username,
            'nomor_pekerja' => $request->nomor_pekerja,
            'fungsi' => $request->fungsi,
            'bagian' => $request->bagian,
            'id_kategori_pembeli' => $request->id_kategori_pembeli,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp_pembeli' => $request->no_hp_pembeli,
            'alamat' => $request->alamat,
        ]);

        Auth::guard('pembeli')->logout();
        return redirect('/')->with('status', '0');
    }

    public function __login(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = $request->only('username', 'password');

        if (Auth::guard('pembeli')->attempt($data)) {
            Auth::guard('merchant')->logout();
            Auth::guard('superuser')->logout();
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Username/Password Salah');

    }

    public function login(){
        if(Auth::guard('pembeli')->check()){
            return redirect('/pembeli/dashboard');
        }else{
            return view('pembeli.login');
        }
    }

    public function dashboard(){
        if(Auth::guard('pembeli')->check()){
            $pembeli = Pembeli::where('id', Auth::guard('pembeli')->user()->id)->first();
            // return $merchant;
            $poin = Transaksi::select(DB::raw('SUM(total_transaksi) as total_transaksi'))->where('status_transaksi', 3)->where('id_merchant', $pembeli->id)->get();
            $poin = floor($poin[0]->total_transaksi/5000);
            Pembeli::where('id', $pembeli->id)
                    ->update([
                        'point_pembeli_pending' => $poin,
                    ]);
            $poin_pending = Pembeli::where('id', $pembeli->id)->first();
            $transaksi_bayar = Transaksi::where('status_transaksi', 0)->where('id_pembeli', $pembeli->id)->count();
            $transaksi_kirim = Transaksi::where('status_transaksi', 1)->where('id_pembeli', $pembeli->id)->count();
            $transaksi_konfirmasi = Transaksi::where('status_transaksi', 2)->where('id_pembeli', $pembeli->id)->count();
            $transaksi_selesai = Transaksi::where('status_transaksi', 3)->where('id_pembeli', $pembeli->id)->count();
            // return $transaksi_kirim;
            return view('pembeli.dashboard.index', compact('pembeli', 'transaksi_bayar','poin_pending', 'transaksi_konfirmasi', 'transaksi_selesai', 'transaksi_kirim'));
        }else{
            return redirect('/pembeli/login');
        }
    }

    public function logout(){
        Auth::guard('pembeli')->logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function show(Pembeli $pembeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembeli $pembeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembeli $pembeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembeli  $pembeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembeli $pembeli)
    {
        //
    }
}
