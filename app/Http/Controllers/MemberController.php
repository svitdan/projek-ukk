<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\PhoneNumber;

class MemberController extends Controller
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
        
        $member = DB::table('tb_member')->get();
        return view('member/index',compact('member'));
    }

    public function store(Request $request)
    {

        $messages   =   [
            'jk.required'       =>  'Jenis Kelamin wajib dipilih',
            'nama_member.required'       =>  'nama wajib diisikan',
            'nama_member.alpha'       =>  'feld nama hanya boleh berupa huruf saja',
            'alamat_member.required' => 'Alamat Wajib di isi',
            'tlp.required' => 'Nomor HP wajib disi',
            'tlp.digits' => 'Nomor HP harus 13 digit'

        ];

        $validasi = Validator::make(
            $request->all(),
            [       
                'jk' => 'required',
                'nama_member' => 'required|alpha',
                'alamat_member' => 'required',
                // 'tlp'=>  ['required', new PhoneNumber],
                'tlp'=>  'required|digits:13',
            ],
            $messages
        );
        if ($validasi->fails()) {
            return back()->withErrors($validasi)->withInput();
        } else {                                

            DB::table('tb_member')->insert([
                'nama_member'=> $request->nama_member,
                'alamat_member' => $request->alamat_member,
                'jk'=>$request->jk,
                'tlp' => $request->tlp,
            ]);
        
            return redirect()->back()->with('masuk','Data Berhasil Di Input');
      
        }    
    
    }

    public function edit($id)
    {
        $member = DB::table('tb_member')->where('id_member',$id)->first();
        return view('member/edit',compact('member'));
    }

    public function update(Request $request)
    {
        
        DB::table('tb_member')->where('id_member',$request->id_member)->update([
            'nama_member'=> $request->nama_member,
            'alamat_member' => $request->alamat_member,
            'jk'=>$request->jk,
            'tlp' => $request->tlp,
        ]);

        return redirect('member')->with('update','Data Berhasil Di Update');
    }


    public function delete(Request $request)
    {
        
        DB::table('tb_member')->where('id_member',$request->id_member)->delete();
        return redirect('member')->with('update','Data Berhasil Di hapus');
    }

}
