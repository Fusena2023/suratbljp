<?php

namespace App\Http\Controllers;

use App\Models\Nonsurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NonsuratController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Nonsurat::where('nama','LIKE','%' .$request->search)->paginate(5);
            Session::put('halaman_url',request()->fullUrl());
        }else{
            //menampilkan 5 baris data
        $data = Nonsurat::paginate(5);
        Session::put('halaman_url',request()->fullUrl());
    }
    return view('nondatasurat',compact('data'));
    }
    public function tambahnondatasurat(){
        return view ('tambahnondatasurat');
    }



    public function insertnondatasurat(Request $request){
        //Nonsurat::create($request->all()); 
        //return redirect()->route('pegawai')->with('success','Data Berhasil Ditambahkan');
        //validasi data
        $this->validate($request,[
            'nama' => 'required|min:7|max:20',
            'kriteriapemohon' => 'required',
            'notlpn'=>'required|min:11|max:13'
        ]);

        $data = Nonsurat::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        //toastr
        return redirect()->route('nondatasurat')->with('success','Data Berhasil Di Tambahkan');
    }

    public function tampilkannondatasurat($id){

        $data = Nonsurat::find($id);
        //dd($data);

        return view('tampilnondatasurat', compact('data'));
    }
//toastr
    public function updatenondatasurat(Request $request, $id){
        $data = Nonsurat::find($id);
        $data->update($request->all());
        if(session(('halaman_url'))){
            return Redirect(session('halaman_url'));
        }
        return redirect()->route('nondatasurat')->with('success','Data Berhasil Diupdate');
    }
//toastr
    public function deletenondatasurat($id)
    {
        $data = Nonsurat::find($id);
        $data->delete();
        return redirect()->route('nondatasurat')->with('success','Data Berhasil Dihapus');
    }
}
