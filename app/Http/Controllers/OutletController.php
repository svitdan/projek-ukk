<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OutletController extends Controller
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
        
        $outlet = DB::table('tb_outlet')->get();
        return view('outlet/index',compact('outlet'));
    }

    public function store(Request $request)
    {


        $messages   =   [            
            'nama_outlet.required'       =>  'nama wajib diisikan',
            'nama_outlet.alpha'       =>  'feld nama hanya boleh berupa huruf saja',
            'alamat_outlet.required' => 'Alamat Wajib di isi',
            'tlp_outlet.required' => 'Nomor HP wajib disi',
            'tlp_outlet.digits' => 'Nomor HP harus 13 digit'

        ];

        $validasi = Validator::make(
            $request->all(),
            [                       
                'nama_outlet' => 'required|alpha',
                'alamat_outlet' => 'required',      
                'tlp_outlet'=>  'required|digits:13', 
            ],
            $messages
        );
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        } else {                                

            DB::table('tb_outlet')->insert([
                'nama_outlet'=> $request->nama_outlet,
                'alamat_outlet' => $request->alamat_outlet,
                'tlp_outlet' => $request->tlp_outlet,
            ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
      
        }    
    
    }

    public function edit($id)
    {
        $outlet = DB::table('tb_outlet')->where('id_outlet',$id)->first();
        return view('outlet/edit',compact('outlet'));
    }

    public function update(Request $request)
    {
        
        DB::table('tb_outlet')->where('id_outlet',$request->id_outlet)->update([
            'nama_outlet'=> $request->nama_outlet,
            'alamat_outlet' => $request->alamat_outlet,
            'tlp_outlet' => $request->tlp_outlet,
        ]);

        return redirect('outlet')->with('update','Data Berhasil Di Update');
    }

    public function delete(Request $request)
    {
        
        DB::table('tb_outlet')->where('id_outlet',$request->id_outlet)->delete();
        return redirect('outlet')->with('update','Data Berhasil Di Hapus');
    }

}
