<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Events\MyEvent;
// panggil model pegawai


class GalangDanaController extends Controller
{



	public function index()
	{
		// mengambil data dari table pegawai
		event(new MyEvent('hello world'));//ini pusher


		$info_atas = DB::table('galang_dana')
		->select(DB::raw('count( distinct galang_dana.id_galang_dana) as jumlah_galang_dana'),DB::raw('count( distinct donasi.id_user) as jumlah_donatur'),DB::raw('SUM(donasi.jumlah_dana) as total_dana_terkumpul' ))
		->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->get();


		$galang_dana = DB::table('galang_dana')
			->select('galang_dana.id_galang_dana','galang_dana.slug', 'galang_dana.tgl_galang_dana','galang_dana.gambar',  'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status', DB::raw('SUM(donasi.jumlah_dana) as terkumpul'),  DB::raw('TIMESTAMPDIFF(DAY, CURDATE(), DATE(galang_dana.tgl_galang_dana) + INTERVAL 30 DAY) AS sisa_hari'), DB::raw('count( distinct donasi.id_user) as jumlah_donatur') )
			->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
			->where('status','YES')
			->groupBy('galang_dana.id_galang_dana','galang_dana.tgl_galang_dana', 'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status','galang_dana.gambar')
			->orderBy('galang_dana.id_galang_dana','desc')
			 ->limit(8)
		->get();


		$slider = DB::table('slider')->where('status','YES')->get();
		$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();


		// mengirim data pegawai ke view index
		return view('galang_dana/index', ['galang_dana' => $galang_dana, 'info_atas' => $info_atas, 'slider' => $slider, 'pengaturan' => $pengaturan,'menu'=>$menu]);
	}

/*	public function list()
    {
    	
    	// mengambil data dari table pegawai
    	$galang_dana = DB::table('galang_dana')
    		->select('galang_dana.id_galang_dana', 'galang_dana.tgl_galang_dana','galang_dana.gambar',  'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status', DB::raw('SUM(donasi.jumlah_dana) as terkumpul'))
    		->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
    		->groupBy('galang_dana.id_galang_dana','galang_dana.tgl_galang_dana', 'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status','galang_dana.gambar')
    		->get();
 
    	// mengirim data pegawai ke view index
    	return view('galang_dana/list', ['galang_dana' => $galang_dana]);
    }
*/

    /*public function store(Request $request){
	// insert data ke table pegawai
	DB::table('galang_dana_view')->insert([
		'nama' => $request->nama,
		'usia' => $request->usia,
		'penyakit' => $request->penyakit,
		'dana' => $request->dana,
		'durasi' => $request->durasi,
		'alamat' => $request->alamat,
		'provinsi' => $request->provinsi,
		'kecamatan' => $request->kecamatan,
		'kodepos' => $request->kodepos,
		'keterangan' => $request->keterangan,
	]);
	// alihkan halaman ke halaman pegawai
	return redirect('/galangdana');
 
	}*/

    public function detail($id, $slug)
    {
	    $pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$detail = DB::table('galang_dana')
		->select('galang_dana.id_galang_dana','galang_dana.slug', 'galang_dana.tgl_galang_dana','galang_dana.gambar',  'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.deskripsi', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status', DB::raw('SUM(donasi.jumlah_dana) as terkumpul'),  DB::raw('TIMESTAMPDIFF(DAY, CURDATE(), DATE(galang_dana.tgl_galang_dana) + INTERVAL 30 DAY) AS sisa_hari'), DB::raw('count( distinct donasi.id_user) as jumlah_donatur') )
		->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->where('galang_dana.id_galang_dana',$id)
		->groupBy('galang_dana.id_galang_dana','galang_dana.tgl_galang_dana', 'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status','galang_dana.gambar')
		->get();

		$perkembangan = DB::table('perkembangan')
		->where('id_galang_dana',$id)
		->get();


		$donatur = DB::table('detail_donatur_view')
		->where('id_galang_dana',$id)->limit(5)->get();

		$jml_donatur = DB::table('detail_donatur_view')
		->select( DB::raw('COUNT( DISTINCT id_user) as jml'))
		->where('id_galang_dana',$id)
		->get();

    	return view('galang_dana/detail', ['pengaturan' => $pengaturan, 'menu' => $menu, 'detail'=> $detail,'donatur' => $donatur,'jml_donatur'=>$jml_donatur,'perkembangan'=>$perkembangan ]);
	}


	public function kirim_email(Request $request){
	{
	    try{
	        Mail::send('galang_dana/email/email', ['nama' => $request->nama, 'pesan' => $request->pesan], function ($message) use ($request)
	        {
	            $message->subject($request->judul);
	            $message->from('donotreply@kiddy.com', 'Kiddy');
	            $message->to($request->email);
	        });
	        return back()->with('alert-success','Berhasil Kirim Email');
	    }
	    catch (Exception $e){
	        return response (['status' => false,'errors' => $e->getMessage()]);
	    }
	}

	}

}