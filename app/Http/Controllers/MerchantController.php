<?php

namespace App\Http\Controllers;

use App\JenisMerchant;
use App\KategoriMerchant;
use App\Merchant;
use App\Pembeli;
use App\Produk;
use App\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MerchantController extends Controller
{

    protected $redirectTo = '/dashboard/merchant';
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriMerchant = KategoriMerchant::get();
        $jenisMerchant = JenisMerchant::get();
        return view('merchant.register', compact('kategoriMerchant', 'jenisMerchant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik_merchant' => 'required|string',
            'nama_merchant' => 'required',
            'kategori_merchant' => 'min:1|not_in:0',
            'jenis_merchant' => 'min:1|not_in:0',
            'username' => 'required|max:20|unique:merchant',
            'email' => 'required|unique:merchant|email',
            'password' => 'min:4|confirmed|required',
            'no_hp_merchant' => 'required',
            'alamat' => 'required',
            'id_kategori_merchant' => 'not_in:0',
            'id_jenis_merchant' => 'not_in:0',
        ]);

            Merchant::create([
                'nama_pemilik_merchant' => $request->nama_pemilik_merchant,
                'nama_merchant' => $request->nama_merchant,
                'id_kategori_merchant' => $request->id_kategori_merchant,
                'id_jenis_merchant' => $request->id_jenis_merchant,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'no_hp_merchant' => $request->no_hp_merchant,
                'alamat' => $request->alamat,
            ]);

            Auth::guard('merchant')->logout();
            return redirect('/')->with('status', '0');
    }


    public function __login(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = $request->only('username', 'password');
        $status = Merchant::where('username', $request->username)->first();

        if (Auth::guard('merchant')->attempt($data)) {
            if ($status->acc_status == 0) {
                Auth::guard('merchant')->logout();
                return redirect('/')->with('aktivasi', '0');
            }else{
                Auth::guard('superuser')->logout();
                Auth::guard('pembeli')->logout();
                return redirect('/merchant/dashboard');
            }
        }
        return redirect()->back()->with('error', 'Username/Password Salah');

    }

    public function login(){
        if(Auth::guard('merchant')->check()){
            return redirect('/merchant/dashboard');
        }else{
            return view('merchant.login');
        }
    }

    public function dashboard(){
        if(Auth::guard('merchant')->check()){
            $merchant = Merchant::where('id', Auth::guard('merchant')->user()->id)->first();
            // return $merchant;
            $poin = Transaksi::where('id_merchant', $merchant->id)->where('status_transaksi', 3)->sum('total_transaksi');
            $poin = floor($poin/200000);
            Merchant::where('id', $merchant->id)
                    ->update([
                        'point_merchant_pending' => $poin,
                    ]);
            $poin_pending = Merchant::where('id', $merchant->id)->first();
            $transaksi_bayar = Transaksi::where('status_transaksi', 0)->where('id_merchant', $merchant->id)->count();
            $transaksi_konfirmasi = Transaksi::where('status_transaksi', 2)->where('id_merchant', $merchant->id)->count();
            $transaksi_kirim = Transaksi::where('status_transaksi', 1)->where('id_merchant', $merchant->id)->count();
            $transaksi_selesai = Transaksi::where('status_transaksi', 3)->where('id_merchant', $merchant->id)->count();
            return view('merchant.dashboard.index', compact('merchant', 'poin_pending', 'transaksi_selesai', 'transaksi_konfirmasi', 'transaksi_bayar', 'transaksi_kirim'));
        }else{
            return redirect('/merchant/login');
        }
    }

    public function logout(){
        Auth::guard('merchant')->logout();
        return redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        $produk = Produk::where('id_merchant', $merchant->id)->get();
        // return $produk;
        return view('produk.detail-merchant', compact('merchant', 'produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        if($request){
            Merchant::where('id', $request->id)
                    ->update([
                        'password' => Hash::make($request->password),
                        'token' => '',
                    ]);
            return redirect('/merchant/login');
        }else{
            return redirect('/');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        //
    }

    public function lupaPassword(){
        $length = 55;
        $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklkmnopqrstuvwxyz'),1,$length);

        return view('merchant.lupa-password', compact('token'));
    }

    public function sendToken(Request $request){
        // return $request->token;
        $merchant = Merchant::where('email', $request->email)->first();
        if($merchant){
            Merchant::where('email', $request->email)->update([
                'token' => $request->token,
            ]);

            try{
                $pesan = '<b>Permintaan Reset Password</b><br>
                            Klik link untuk mengakses Reset Password<br>
                            <a href=https://www.bazokaaa-ru6.com/merchant/reset-password/token='.$request->token.'>Reset Password</a>';
                Mail::send([], [], function ($message) use($pesan, $request) {
                    $message->to($request->email)
                    ->subject('Permintaan Reset Password')
                    ->setBody($pesan, 'text/html');
                });
            }catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
            return view('merchant.reset-password', compact('merchant'));
        }else{

            return redirect()->back()->with('status', 'Email tidak terdaftar');
        }

    }

    public function passwordReset($token){
        $merchant = Merchant::where('token', $token)->first();
        // return $token_merchant;
        if($merchant){
            // return "token sesuai";
            return view('merchant.reset', compact('merchant'));
        }else{
            return view('merchant.reset');
        }
    }


}
