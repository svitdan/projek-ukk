<?php


namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlah_member=DB::table('tb_member')->count();
        $jumlah_paket=DB::table('tb_paket')->count();
        $jumlah_pendapatan=DB::table('tb_detail_transaksi')->sum('harga_total');
        $jumlah_transaksi=DB::table('tb_detail_transaksi')->count();

        $transaksi = DB::table('tb_transaksi')
                ->join('tb_outlet', function($join){
                    $join->on('tb_transaksi.transaksi_outlet_id','=','tb_outlet.id_outlet');
                })
                ->join('tb_member', function($join){
                    $join->on('tb_transaksi.member_id','=','tb_member.id_member');
                })
                ->get(); 

        return view('home',compact('jumlah_member','jumlah_pendapatan','jumlah_paket','jumlah_transaksi','transaksi'));
    }
}
