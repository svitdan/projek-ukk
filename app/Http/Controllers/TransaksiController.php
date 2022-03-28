<?php

namespace App\Http\Controllers;

use DB;
use auth;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ambil(Request $request)
    {
            
        $paket = DB::table("tb_paket")
        ->where("outlet_paket_id",$request->outlet_paket_id)
        ->pluck("nama_paket","id_paket");
        return response()->json($paket);
    }

    public function ambil2(Request $request)
    {
        $paket = DB::table("tb_paket")
        ->where("id_paket",$request->id_paket)
        ->pluck("harga_paket");
        return response()->json($paket);
    }

    public function index()
    {
        
        $transaksi = DB::table('tb_transaksi')
                ->join('tb_outlet', function($join){
                    $join->on('tb_transaksi.transaksi_outlet_id','=','tb_outlet.id_outlet');
                })
                ->join('tb_member', function($join){
                    $join->on('tb_transaksi.member_id','=','tb_member.id_member');
                })
                ->get(); 
        

        return view('transaksi/index',compact('transaksi'));
    }

    public function tambah()
    {
        $outlet= DB::table('tb_outlet')->get();
        $member= DB::table('tb_member')->get();

        $max = DB::table('tb_transaksi')->where('kode_invoice', \DB::raw("(select max(`kode_invoice`) from tb_transaksi)"))->pluck('kode_invoice');
        $check_max = DB::table('tb_transaksi')->count();
        if($check_max == null){
            $kode_invoice = "L0001";
        }else{
            $kode_invoice = $max[0];
            $kode_invoice++;
           
        }

        return view('transaksi/tambah',compact('outlet','member','kode_invoice'));
    }

    public function store(Request $request)
    {

            DB::table('tb_transaksi')->insert([
                'transaksi_outlet_id'=> $request->transaksi_outlet_id,
                'kode_invoice' => $request->kode_invoice,
                'member_id'=>$request->member_id,
                'tgl_transaksi' => $request->tgl_transaksi,
                'batas_waktu' => $request->batas_waktu,
                'tgl_bayar' => $request->tgl_bayar,
                'biaya_tambahan' => $request->biaya_tambahan,
                'diskon' => $request->diskon,
                'pajak' => $request->pajak,
                'status_pakaian' => 'baru',
                'status_bayar'=>$request->status_bayar,
                'user_id'=>Auth::user()->id,
            ]);


            $cek = DB::table('tb_transaksi')->where('id_transaksi', \DB::raw("(select max(`id_transaksi`) from tb_transaksi)"))->first();
            
            DB::table('tb_detail_transaksi')->insert([
                'transaksi_id'=> $cek->id_transaksi,
                'paket_id' => $request->paket_id,
                'qty' => $request->qty,
                'keterangan' => $request->keterangan,
                'sub_total' => $request->sub_total,
                'harga_total' => $request->harga_total,
            ]);

        $struk = DB::table('tb_detail_transaksi')->where('transaksi_id',$cek->id_transaksi)
                ->join('tb_transaksi', function($join){
                    $join->on('tb_detail_transaksi.transaksi_id','=','tb_transaksi.id_transaksi');
                })
                ->join('tb_paket', function($join){
                    $join->on('tb_detail_transaksi.paket_id','=','tb_paket.id_paket');
                })
                ->join('tb_outlet', function($join){
                    $join->on('tb_paket.outlet_paket_id','=','tb_outlet.id_outlet');
                })
                ->join('tb_member', function($join){
                    $join->on('tb_transaksi.member_id','=','tb_member.id_member');
                })
                ->join('users', function($join){
                    $join->on('tb_transaksi.user_id','=','users.id');
                })
                ->first(); 
    
        
        return view('transaksi/detail',compact('struk'));
    }

    public function cetak($id)
    {
        $struk = DB::table('tb_detail_transaksi')->where('transaksi_id',$id)
                ->join('tb_transaksi', function($join){
                    $join->on('tb_detail_transaksi.transaksi_id','=','tb_transaksi.id_transaksi');
                })
                ->join('tb_paket', function($join){
                    $join->on('tb_detail_transaksi.paket_id','=','tb_paket.id_paket');
                })
                ->join('tb_outlet', function($join){
                    $join->on('tb_paket.outlet_paket_id','=','tb_outlet.id_outlet');
                })
                ->join('tb_member', function($join){
                    $join->on('tb_transaksi.member_id','=','tb_member.id_member');
                })
                ->join('users', function($join){
                    $join->on('tb_transaksi.user_id','=','users.id');
                })
                ->first(); 
    
        
        return view('transaksi/struk',compact('struk'));
    }

    public function show($id)
    {
        $struk = DB::table('tb_detail_transaksi')->where('transaksi_id',$id)
                ->join('tb_transaksi', function($join){
                    $join->on('tb_detail_transaksi.transaksi_id','=','tb_transaksi.id_transaksi');
                })
                ->join('tb_paket', function($join){
                    $join->on('tb_detail_transaksi.paket_id','=','tb_paket.id_paket');
                })
                ->join('tb_outlet', function($join){
                    $join->on('tb_paket.outlet_paket_id','=','tb_outlet.id_outlet');
                })
                ->join('tb_member', function($join){
                    $join->on('tb_transaksi.member_id','=','tb_member.id_member');
                })
                ->join('users', function($join){
                    $join->on('tb_transaksi.user_id','=','users.id');
                })
                ->first(); 
    
        
        return view('transaksi/show',compact('struk'));
    }


    public function pakaian1($id)
    {
        $struk = DB::table('tb_transaksi')->where('id_transaksi',$id)->update([
            'status_pakaian' => 'proses',
        ]);

        return redirect()->back()->with('update','Data Berhasil Di Ubah');
    }

    public function pakaian2($id)
    {
        $struk = DB::table('tb_transaksi')->where('id_transaksi',$id)->update([
            'status_pakaian' => 'selesai',
        ]);

        return redirect()->back()->with('update','Data Berhasil Di Ubah');
    }

    public function pakaian3($id)
    {
        $struk = DB::table('tb_transaksi')->where('id_transaksi',$id)->update([
            'status_pakaian' => 'diambil',
        ]);

        return redirect()->back()->with('update','Data Berhasil Di Ubah');
    }


    public function bayar1($id)
    {
        $struk = DB::table('tb_transaksi')->where('id_transaksi',$id)->update([
            'status_bayar' => 'dibayar',
        ]);

        return redirect()->back()->with('update','Data Berhasil Di Ubah');
    }
    

}
