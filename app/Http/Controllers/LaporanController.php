<?php

namespace App\Http\Controllers;

use DB;
use auth;
use App\Exports\LaporanExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class LaporanController extends Controller
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
    

    public function index(Request $request)
    {
        $transaksi = DB::table("tb_transaksi")
                        ->whereBetween('tgl_transaksi',[$request->tanggal1,$request->tanggal2])
                        ->where('status_bayar',$request->status_bayar)
                        ->join('tb_detail_transaksi', function($join){
                            $join->on('tb_transaksi.id_transaksi','=','tb_detail_transaksi.transaksi_id');
                        })->get(); 

        $hitung=count($transaksi);
        $req1=$request->tanggal1;
        $req2=$request->tanggal2;
        $req3=$request->status_bayar;

        return view('laporan/index',compact('transaksi','hitung','req1','req2','req3'));
    }

    public function export_excel(Request $request)
    {
        $data = DB::table("tb_transaksi")
                        ->whereBetween('tgl_transaksi',[$request->tanggal1,$request->tanggal2])
                        ->where('status_bayar',$request->status_bayar)
                        ->join('tb_detail_transaksi', function($join){
                            $join->on('tb_transaksi.id_transaksi','=','tb_detail_transaksi.transaksi_id');
                        })->get(); 
          

        return Excel::download(new LaporanExcel($data), 'Laporan_excel.xlsx');
    }

    public function export_pdf(Request $request)
    {
    	$transaksi = DB::table("tb_transaksi")
                        ->whereBetween('tgl_transaksi',[$request->tanggal1,$request->tanggal2])
                        ->where('status_bayar',$request->status_bayar)
                        ->join('tb_detail_transaksi', function($join){
                            $join->on('tb_transaksi.id_transaksi','=','tb_detail_transaksi.transaksi_id');
                        })->get(); 
 
    	$pdf = PDF::loadview('laporan.transaksi_pdf',['transaksi'=>$transaksi]);
    	return $pdf->download('laporan.pdf');
    }

}