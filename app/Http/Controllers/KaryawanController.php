<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Exports\ExportSurat;
use App\Imports\ImportSurat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Karyawan::where('nama','LIKE','%' .$request->search)->paginate(5);
            Session::put('halaman_url',request()->fullUrl());
        }else{
            //menampilkan 5 baris data
        $data = Karyawan::paginate(5);
        Session::put('halaman_url',request()->fullUrl());
    }
    return view('datapegawai',compact('data'));
    }
    public function tambahdatasurat(){
        return view ('tambahdata');
    }



    public function insertdata(Request $request){
        //Karyawan::create($request->all()); 
        //return redirect()->route('pegawai')->with('success','Data Berhasil Ditambahkan');
        //validasi data
        $this->validate($request,[
            'nama' => 'required|min:7|max:20',
            'kriteriapemohon' => 'required',
            'notlpn'=>'required|min:11|max:13'
        ]);

        $data = Karyawan::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        //toastr
        return redirect()->route('datasurat')->with('success','Data Berhasil Di Tambahkan');
    }

    public function tampilkandata($id){

        $data = Karyawan::find($id);
        //dd($data);

        return view('tampildata', compact('data'));
    }
//toastr
    public function updatedata(Request $request, $id){
        $data = Karyawan::find($id);
        $data->update($request->all());
        if(session(('halaman_url'))){
            return Redirect(session('halaman_url'));
        }
        return redirect()->route('datasurat')->with('success','Data Berhasil Diupdate');
    }
//toastr
    public function delete($id){
        $data = Karyawan::find($id);
        $data->delete();
        return redirect()->route('datasurat')->with('success','Data Berhasil Dihapus');
    }
//exportpdf
    // public function exportpdf (){
    //     $data = Karyawan::all();
    //     view()->share('data', $data);
    //     $pdf = PDF::loadview('datasurat-pdf');
    //     return $pdf->download('data.pdf');

    // }
        public function exportexcel(){
            return Excel::download(new ExportSurat,'datasurat.xlsx');
        }

        public function importexcel(Request $request){
            $data = $request->file('file');
            $namafile = $data->getClientOriginalName();
            $data->move('KarywanData', $namafile);

            Excel::import(new ImportSurat, \public_path('/KaryawanData/',$namafile));
            return \redirect()->back();
        }
}


