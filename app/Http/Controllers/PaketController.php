<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
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


    public function index()
    {
        
        $paket = DB::table('tb_paket')
                ->join('tb_outlet', function($join){
                    $join->on('tb_paket.outlet_paket_id','=','tb_outlet.id_outlet');
                })
                ->join('tb_jenis', function($join){
                    $join->on('tb_paket.jenis_id','=','tb_jenis.id_jenis');
                })
                ->get(); 
        
        $outlet= DB::table('tb_outlet')->get();
        $jenis= DB::table('tb_jenis')->get();

        return view('paket/index',compact('paket','outlet','jenis'));
    }

    public function store(Request $request)
    {

        $messages   =   [            
            'nama_paket.required'       =>  'nama wajib diisikan',
            'nama_paket.alpha'       =>  'feld nama hanya boleh berupa huruf saja',
            'harga_paket.required' => 'Harga wajib disi',
            'jenis_id.required' => 'jenis wajib disi',            

        ];

        $validasi = Validator::make(
            $request->all(),
            [                       
                'nama_paket' => 'required|alpha',
                'harga_paket' => 'required',      
                'jenis_id' => 'required',                                
            ],
            $messages
        );
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        } else {                                

            DB::table('tb_paket')->insert([
                'outlet_paket_id'=> $request->outlet_paket_id,
                'jenis_id' => $request->jenis_id,
                'nama_paket'=>$request->nama_paket,
                'harga_paket' => $request->harga_paket,
            ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
      
        }    

       
    }

    public function edit($id)
    {
        $paket = DB::table('tb_paket')->where('id_paket',$id)
                ->join('tb_outlet', function($join){
                    $join->on('tb_paket.outlet_paket_id','=','tb_outlet.id_outlet');
                })
                ->join('tb_jenis', function($join){
                    $join->on('tb_paket.jenis_id','=','tb_jenis.id_jenis');
                })->first();

        $outlet= DB::table('tb_outlet')->get();
        $jenis= DB::table('tb_jenis')->get();
        
        return view('paket/edit',compact('paket','outlet','jenis'));
    }

    public function update(Request $request)
    {
        
        DB::table('tb_paket')->where('id_paket',$request->id_paket)->update([
            'outlet_paket_id'=> $request->outlet_paket_id,
            'jenis_id' => $request->jenis_id,
            'nama_paket'=>$request->nama_paket,
            'harga_paket' => $request->harga_paket,
        ]);

        return redirect('paket')->with('update','Data Berhasil Di Update');
    }

    public function delete(Request $request)
    {
        
        DB::table('tb_paket')->where('id_paket',$request->id_paket)->delet();

        return redirect('paket')->with('update','Data Berhasil Di Hapus');
    }

}
