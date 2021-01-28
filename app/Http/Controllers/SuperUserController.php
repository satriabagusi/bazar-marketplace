<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Produk;
use App\SuperUser;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperUserController extends Controller
{
    protected $redirectTo = '/dashboard/superuser';
    public function __construct()
    {
        $this->middleware('superuser');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi_count = Transaksi::all()->count();
        $transaksi_bayar = Transaksi::where('status_transaksi', 0)->count();
        $transaksi_kirim = Transaksi::where('status_transaksi', 1)->count();
        $transaksi_selesai = Transaksi::where('status_transaksi', 3)->count();
        return view('superuser.dashboard.index', compact('transaksi_count', 'transaksi_bayar', 'transaksi_kirim', 'transaksi_selesai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superuser.akun.tambah-user');
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
            'nama' => 'required|string',
            'no_hp_superuser' => 'required',
            'username' => 'required|max:20|unique:superuser',
            'email' => 'required|unique:superuser|email',
            'password' => 'min:4|required',
        ]);

        SuperUser::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'no_hp_superuser' => $request->no_hp_superuser,
        ]);

            return redirect('/superuser/dashboard/tambah-user')->with('status', '0');
    }

    public function __login(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = $request->only('username', 'password');

        if (Auth::guard('superuser')->attempt($data)) {
            Auth::guard('merchant')->logout();
            Auth::guard('pembeli')->logout();
            return redirect('/superuser/dashboard');
        }
        return redirect()->back()->with('error', 'Username/Password Salah');

    }

    public function login(){
        if(Auth::guard('superuser')->check()){
            return redirect('/superuser/dashboard');
        }else{
            return view('superuser.login');
        }
    }

    public function dashboard(){
        if(Auth::guard('superuser')->check()){
            return view('superuser.dashboard.index');
        }else{
            return redirect('/superuser/login');
        }
    }

    public function logout(){
        Auth::guard('superuser')->logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuperUser  $superUser
     * @return \Illuminate\Http\Response
     */
    public function show(SuperUser $superUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuperUser  $superUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SuperUser $superUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuperUser  $superUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuperUser $superUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuperUser  $superUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuperUser $superUser)
    {
        //
    }


    public function __aktivasi(Merchant $merchant){
        if(Auth::guard('superuser')->check()){
            DB::transaction(function() use($merchant) {
                Merchant::where('id', $merchant->id)
                ->update([
                    'acc_status' => 1,
                ]);

            });

            return redirect('/superuser/dashboard/daftar-merchant/');
        }
    }

    public function __nonaktif(Merchant $merchant){
        if(Auth::guard('superuser')->check()){
            DB::transaction(function() use($merchant) {
                Merchant::where('id', $merchant->id)
                ->update([
                    'acc_status' => 0,
                ]);

            });

            return redirect('/superuser/dashboard/daftar-merchant/');
        }
    }

    public function daftarMerchant(){
        $merchant = Merchant::paginate(15);
        // return $merchant;
        if(Auth::guard('superuser')->check()){
            return view('superuser.akun.daftar-merchant', compact('merchant'));
        }else{
            return redirect('/superuser/login');
        }
    }


    public function __hapusAkun(Merchant $merchant){
        Produk::where('id_merchant', $merchant->id)->delete();
        Merchant::destroy($merchant->id);
        return back()->with('status', 'Merchant '.$merchant->nama_merchant.' berhasil dihapus !');
    }
}