<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class JenisController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        
        $jenis = DB::table('tb_jenis')->get();
        return view('jenis/index',compact('jenis'));
    }

    public function store(Request $request)
    {

        $messages   =   [            
            'nama_jenis.required'       =>  'nama wajib diisikan',
            'nama_jenis.alpha'       =>  'feld nama hanya boleh berupa huruf saja',         

        ];

        $validasi = Validator::make(
            $request->all(),
            [                       
                'nama_jenis' => 'required|alpha',         
            ],
            $messages
        );
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        } else {                                

            DB::table('tb_jenis')->insert([
                'nama_jenis'=> $request->nama_jenis,
            ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
      
        }    


     
    }

    public function edit($id)
    {
        $jenis = DB::table('tb_jenis')->where('id_jenis',$id)->first();
        return view('jenis/edit',compact('jenis'));
    }

    public function update(Request $request)
    {
        DB::table('tb_jenis')->where('id_jenis',$request->id_jenis)->update([
            'nama_jenis'=> $request->nama_jenis,
        ]);

        return redirect('jenis')->with('update','Data Berhasil Di Update');
    }

    public function delete(Request $request)
    {
        DB::table('tb_jenis')->where('id_jenis',$request->id_jenis)->delete();

        return redirect('jenis')->with('update','Data Berhasil Di Hapus');
    }

}
