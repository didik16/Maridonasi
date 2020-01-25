<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Excel;
use App\Exports\GalangDanaReport;

class BackendController extends Controller
{
/*    public function index()
    {
    	// mengambil data dari table pegawai
    	$galang_dana = DB::table('galang_dana_view')->get();
 
    	// mengirim data pegawai ke view index
    	return view('galang_dana/list', ['galang_dana' => $galang_dana]);
    }*/

public function index()
{

	$id_user = Auth::user()->id;
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();

	$detail = DB::table('galang_dana')
	->select(DB::raw('count( distinct galang_dana.id_galang_dana) as jumlah_galang_dana'),DB::raw('count( distinct donasi.id_user) as jumlah_donatur'),DB::raw('SUM(donasi.jumlah_dana) as total_dana_terkumpul' ) )
	->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
	->get();

	return view('backend_admin/dashboard_admin',['pengaturan' => $pengaturan, 'menu' => $menu, 'detail'=>$detail]);

}


    public function galang_dana()
    {
    	
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$galang_dana = DB::table('galang_dana')
		->orderBy('id_galang_dana','desc')
		->paginate(5);

    	return view('backend_admin/galang_dana', ['pengaturan' => $pengaturan, 'menu' => $menu,'galang_dana'=>$galang_dana]);
	}


public function verifikasi_galang_dana()
{	
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();

	$galang_dana = DB::table('galang_dana')
        ->select('*')->where('status','CEK')
        ->orderBy('id_galang_dana','ASC')->get();

	return view('backend_admin/verifikasi_galang_dana',['pengaturan' => $pengaturan, 'menu' => $menu,'galang_dana' => $galang_dana]);
}


	public function data_verifikasi_galang_dana()
    {
        $galang_dana = DB::table('galang_dana')
        ->select('*')->where('status','CEK')
        ->orderBy('id_galang_dana','ASC');
        return datatables()->of($galang_dana)
            ->make(true);
    }

    public function detail_galang_dana(Request $request,$id)
    {
        $detail_galang_dana = DB::table('galang_dana')
        ->where('id_galang_dana',$id)->get();
        return view('backend_admin.detail_galang_dana',compact('detail_galang_dana'));
    }


public function donasi()
{
	
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();

	$donasi = DB::table('galang_dana')
		->select('galang_dana.id_galang_dana','galang_dana.judul','galang_dana.gambar', 'donasi.tgl_donasi','donasi.jumlah_dana','donasi.status_dana','donasi.status_dana','donasi.id_user')
		->join('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->orderBy('galang_dana.id_galang_dana','desc')
		->paginate(5);

	return view('backend_admin/donasi',['pengaturan' => $pengaturan, 'menu' => $menu,'donasi'=>$donasi ]);

}


public function transaksi_saldo()
{
	
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();

	$saldo = DB::table('saldo')
	->select(DB::raw('saldo.id as id_saldo, users.name, saldo.created_at, saldo.jumlah, saldo.status '))
		->join('users', 'saldo.id_user', '=', 'users.id')
		->orderBy('saldo.id','desc')
		->get();

	return view('backend_admin/transaksi_saldo',['pengaturan' => $pengaturan, 'menu' => $menu,'saldo'=>$saldo ]);

}


public function pencairan_dana()
{
	
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();

	$pencairan_dana = DB::table('pencairan_dana')->get();

	return view('backend_admin/pencairan_dana',['pengaturan' => $pengaturan, 'menu' => $menu,'pencairan_dana'=>$pencairan_dana ]);

}

public function laporan_galang_dana()
    {
        return Excel::download(new GalangDanaReport, 'Galang_Dana.xlsx');
    }



}