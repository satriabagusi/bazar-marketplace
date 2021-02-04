<?php

namespace App\Http\Controllers;

use App\KategoriPembeli;
use App\Pembeli;
use App\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'email' => 'required|unique:pembeli',
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
            $pembeli = Pembeli::where('id', Auth::guard('pembeli')->user()->id)->first();
            // return $pembeli->id;
            $poin = Transaksi::where('id_pembeli', $pembeli->id)->where('status_transaksi', 3)->sum('total_transaksi');
            $poin = floor($poin/5000);
            // return $poin;
            Pembeli::where('id', $pembeli->id)
                    ->update([
                        'point_pembeli_pending' => $poin,
                    ]);
            return redirect('/pembeli/dashboard');
        }else{
            return view('pembeli.login');
        }
    }

    public function dashboard(){
        if(Auth::guard('pembeli')->check()){
            $pembeli = Pembeli::where('id', Auth::guard('pembeli')->user()->id)->first();
            // return $pembeli->id;
            $poin = Transaksi::where('id_pembeli', $pembeli->id)->where('status_transaksi', 3)->sum('total_transaksi');
            $poin = floor($poin/5000);
            // return $poin;
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
        if($request){
            Pembeli::where('id', $request->id)
                    ->update([
                        'password' => Hash::make($request->password),
                        'token' => '',
                    ]);
            return redirect('/pembeli/login');
        }else{
            return redirect('/');
        }
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

    public function lupaPassword(){
        $length = 55;
        $token = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklkmnopqrstuvwxyz'),1,$length);

        return view('pembeli.lupa-password', compact('token'));
    }

    public function sendToken(Request $request){
        // return $request->all();
        $pembeli = Pembeli::where('email', $request->email)->first();
        if($pembeli){
            Pembeli::where('email', $request->email)->update([
                'token' => $request->token,
            ]);

            try{
                $pesan = '<b>Permintaan Reset Password</b><br>
                            Klik link untuk mengakses Reset Password<br>
                            <a href='.env('APP_URL').'/pembeli/reset-password/token='.$request->token.'>Reset Password</a>';
                Mail::send([], [], function ($message) use($pesan, $request) {
                    $message->to($request->email)
                    ->subject('Permintaan Reset Password')
                    ->setBody($pesan, 'text/html');
                });
            }catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }

            return view('pembeli.reset-password', compact('pembeli'));

        }else{

            return redirect()->back()->with('status', 'Email tidak terdaftar');
        }

    }

    public function passwordReset($token){
        // return $token;
        $pembeli = Pembeli::where('token', $token)->first();
        // return $token_merchant;
        if($pembeli){
            // return "token sesuai";
            return view('pembeli.reset', compact('pembeli'));
        }else{
            return view('pembeli.reset');
        }
    }
}
