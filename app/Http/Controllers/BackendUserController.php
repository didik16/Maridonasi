<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Validator;
use Image;

use App\Model\Saldo;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;



class BackendUserController extends Controller
{

protected $request;



public function __construct(Request $request)
{
    $this->request = $request;

    // Set midtrans configuration
    Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
    Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
    Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
    Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
}

public function index()
{
	$id_user = Auth::user()->id;
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();


	$donasi_saya = DB::table('galang_dana')
		->select('galang_dana.id_galang_dana','galang_dana.judul','galang_dana.gambar', 'donasi.tgl_donasi','donasi.jumlah_dana','donasi.status_dana','donasi.status_dana')
		->join('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->where('donasi.id_user',$id_user)
		->paginate(5);

	$detail_donasi_user = DB::table('donasi')
	->select(DB::raw('SUM(jumlah_dana) as jumlah_dana'), DB::raw('count(id) as jumlah_donasi') )
	->where('id_user',$id_user)
	->get();


//chart
	 $bulan = date('m');
     $tahun =date('Y');

	$galang_dana = DB::table('donasi')
->select(DB::raw('DATE(tgl_donasi) as tgl'), DB::raw('SUM(jumlah_dana) as jumlah_dana'))

/*		->where('month(tgl_donasi)',$bulan)
		->where('year(tgl_donasi)',$tahun)*/

		->where('id_user',$id_user)
		->groupBy('tgl')
		->get();



	$tanggal = [];
	$dana = [];
	foreach ($galang_dana as $galang_dana) {
		$tanggal[] = date('d', strtotime($galang_dana->tgl));
		$dana[] = (int)$galang_dana->jumlah_dana;
	}


//akhir chart

	$detail_donasi_user = DB::table('donasi')
	->select(DB::raw('SUM(distinct donasi.jumlah_dana) as jumlah_dana'), DB::raw('count(distinct donasi.id) as jumlah_donasi'), DB::raw('count(distinct galang_dana.id_galang_dana) as jumlah_galang'))
	->join('galang_dana', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
	->where('galang_dana.id_user',$id_user)
	->get();


		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

		

	return view('backend_user/dashboard',['pengaturan' => $pengaturan, 'menu' => $menu,'donasi_saya'=>$donasi_saya, 'detail_donasi_user'=>$detail_donasi_user,'galang_dana'=>$galang_dana,'tanggal' => $tanggal,'dana'=>$dana,'detail_donasi_user'=>$detail_donasi_user,'detail_saldo'=>$detail_saldo]);

}


public function donasi_saya()
{
	$id_user = Auth::user()->id;
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();



	$donasi_saya = DB::table('galang_dana')
		->select('galang_dana.id_galang_dana','galang_dana.judul','galang_dana.gambar', 'donasi.tgl_donasi','donasi.jumlah_dana','donasi.status_dana','donasi.status_dana','donasi.snap_token')
		->join('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->where('donasi.id_user',$id_user)
		->orderBy('galang_dana.id_galang_dana','desc')
		->paginate(5);

	$detail_donasi_user = DB::table('donasi')
	->select(DB::raw('SUM(jumlah_dana) as jumlah_dana'), DB::raw('count(id) as jumlah_donasi') )
	->where('id_user',$id_user)
	->get();

	$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

		

	return view('backend_user/donasi_saya',['pengaturan' => $pengaturan, 'menu' => $menu,'donasi_saya'=>$donasi_saya, 'detail_donasi_user'=>$detail_donasi_user,'detail_saldo'=>$detail_saldo]);

}



public function cari_donasi_saya(Request $request) //pakai request karena get data dari inputan
{
	$id_user = Auth::user()->id; //get id user yg login di session

	$pengaturan = DB::table('pengaturan')->get(); //buat footer
	$menu = DB::table('menu')->get(); //buat menu di header


	$donasi_saya = DB::table('galang_dana') //ini pencarian
		->select('galang_dana.id_galang_dana','galang_dana.judul','galang_dana.gambar', 'donasi.tgl_donasi','donasi.jumlah_dana','donasi.status_dana','donasi.status_dana','donasi.snap_token')
		->join('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->where('galang_dana.judul','LIKE', "%{$request->cari}%") //ini yg penting
		->where('donasi.id_user',$id_user) 
		->paginate(5); //buat pagination

	$donasi_saya->appends($request->only('cari')); //artinya cuma dari input bernama cari yg dapat dipakai 

	$detail_donasi_user = DB::table('donasi') //untuk menampilkan data detail donasi ( abaikan )
		->select(DB::raw('SUM(jumlah_dana) as jumlah_dana'), DB::raw('count(id) as jumlah_donasi') )
		->where('id_user',$id_user)
		->get();

	$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

	
	 

	return view('backend_user/donasi_saya',['pengaturan' => $pengaturan, 'menu' => $menu,'donasi_saya'=>$donasi_saya, 'detail_donasi_user'=>$detail_donasi_user,'detail_saldo'=>$detail_saldo]); //returnnya
}



    public function galang_dana()
    {
    	$id_user = Auth::user()->id;
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$galang_dana = DB::table('galang_dana')
		->where('id_user',$id_user)
		->orderBy('id_galang_dana','desc')
		->paginate(5);

		$detail_galang_dana_user = DB::table('galang_dana')
		->select(DB::raw('SUM(donasi.jumlah_dana) as jumlah_dana'), DB::raw('count(distinct galang_dana.id_galang_dana) as jumlah_galang_dana') )
		->join('donasi', 'donasi.id_galang_dana', '=', 'galang_dana.id_galang_dana')
		->where('galang_dana.id_user',$id_user)
		->get();

		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

		

    	return view('backend_user/galang_dana', ['pengaturan' => $pengaturan, 'menu' => $menu,'galang_dana'=>$galang_dana,'detail_galang_dana_user'=>$detail_galang_dana_user,'detail_saldo'=>$detail_saldo]);
	}





	public function cari_galang_dana(Request $request)
    {
    	$id_user = Auth::user()->id;
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$galang_dana = DB::table('galang_dana')
		->where('id_user',$id_user)
		->where('galang_dana.judul','LIKE', "%{$request->cari}%")
		->paginate(5);

		$galang_dana->appends($request->only('cari'));

		$detail_galang_dana_user = DB::table('galang_dana')
		->select(DB::raw('SUM(donasi.jumlah_dana) as jumlah_dana'), DB::raw('count(distinct galang_dana.id_galang_dana) as jumlah_galang_dana') )
		->join('donasi', 'donasi.id_galang_dana', '=', 'galang_dana.id_galang_dana')
		->where('galang_dana.id_user',$id_user)
		->get();

		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();




    	return view('backend_user/galang_dana', ['pengaturan' => $pengaturan, 'menu' => $menu,'galang_dana'=>$galang_dana,'detail_galang_dana_user'=>$detail_galang_dana_user,'detail_saldo'=>$detail_saldo]);
	}




    public function buat_galang_dana()
    {
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

    	return view('backend_user/buat_galang_dana', ['pengaturan' => $pengaturan, 'menu' => $menu,'detail_saldo'=>$detail_saldo]);
	}



function store_galang_dana(Request $request)
    {

  /*  $validator = Validator::make($request->all(), [
      'foto'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'judul' => 'required',
      'cek' => 'required'
     ]);*/


     $messages = [
    'required' => ':attribute Wajib diisi',
    'min' => ':attribute harus diisi minimal :min karakter',
    'max' => ':attribute harus diisi maksimal :max karakter',
    'image' => ':attribute wajib menggunakan file Foto format jpeg/png/jpg',
    'cek.required' => 'Centang untuk menyetujui',
    'dana.required' => 'Jumlah Dana harus diisi minimal 1jt Maksimal 500jt',
    'slug.unique' => 'Alamat URL sudah digunakan',
	];

    $this->validate($request,[
    'judul' => 'required',
    'foto'  => 'required|image|mimes:jpeg,png,jpg',
    'cek' => 'required',
    'dana' => 'required',
    'alamat' => 'required',
    'slug' => 'required|unique:galang_dana,slug',
	],$messages);

	
     

	     $image = $request->file('foto');
	     $image_name = str_replace(' ','_',$request->judul).'_'.time() . '.' . $image->getClientOriginalExtension();
	     $destinationPath = public_path('/assets/img/galang_dana');


	     $resize_image = Image::make($image->getRealPath());
	     $resize_image->resize(150, 150, function($constraint){
	      $constraint->aspectRatio();
	     })->save($destinationPath . '/' . $image_name);

	     $destinationPath = public_path('/assets/img/galang_dana/resize');
	     $image->move($destinationPath, $image_name);

     	// insert data ke table pegawai
		DB::table('galang_dana')->insert([
			'id_user' => Auth::user()->id,
			'judul' => $request->judul,
			'gambar' => $image_name,
			'jumlah_dana' => str_replace('.', '', $request->dana),
			'durasi' => $request->hari,
			'alamat' => $request->alamat,
			'slug' => $request->slug,
			'deskripsi' => $request->keterangan,

		]);
			

	//return response()->json(['error'=>$validator->errors()->all()]);

    

    return redirect('/dashboard/galang_dana');

}


/*public function proses_upload(Request $request){
	
		$image = $request->file('image');
        $filename = 'image_'.time().'_'.$image->hashName();
        $image = $image->move(public_path('assets/img/galang_dana'), $filename);
        return mce_back($filename);

	}*/

	public function upload_ckeditor(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
 
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
             
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    }


	/*public function test_gambar()
    {

    	return view('backend_user/testimage');
	}



	public function store_gambar(request $request) {

    $input=$request->all();
    $images=array();
    if($files=$request->file('images')){
        foreach($files as $file){
            $name=$file->getClientOriginalName();
            $file->move(\public_path() ."/images", $name);
            $images[]=$name;
        }
    }

		DB::table('testimage')->insert([
        'gambar'=>  implode("|",$images),
        
        //you can put other insertion here
    ]);


    return redirect('/dashboard');
}
*/


	public function edit_galang_dana($id,$slug) //XXX belummm
    {
    	$id_user = Auth::user()->id;
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$galang_dana = DB::table('galang_dana')->where('id_galang_dana',$id)->get();


		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

    	return view('backend_user/edit_galang_dana', ['pengaturan' => $pengaturan, 'menu' => $menu,'galang_dana'=>$galang_dana,'detail_saldo'=>$detail_saldo]);
	}



	public function update_galang_dana(Request $request) //XXX belummm
    {
	     $image = $request->file('foto');

	     if($image !=""){

	     $messages = [
	    'required' => ':attribute Wajib diisi',
	    'min' => ':attribute harus diisi minimal :min karakter',
	    'max' => ':attribute harus diisi maksimal :max karakter',
	    'image' => ':attribute wajib menggunakan file Foto format jpeg/png/jpg',
	    'dana.required' => 'Jumlah Dana harus diisi minimal 1jt Maksimal 500jt',
	    
		];

	    $this->validate($request,[
	    'judul' => 'required',
	    'foto'  => 'required|image|mimes:jpeg,png,jpg',
	    'dana' => 'required',
	    'alamat' => 'required',
	    
		],$messages);

	     $image_name = str_replace(' ','_',$request->judul).'_'.time() . '.' . $image->getClientOriginalExtension();
	     $destinationPath = public_path('/assets/img/galang_dana');

	     $resize_image = Image::make($image->getRealPath());
	     $resize_image->resize(150, 150, function($constraint){
	      $constraint->aspectRatio();
	     })->save($destinationPath . '/' . $image_name);

	     $destinationPath = public_path('/assets/img/galang_dana/resize');
	     $image->move($destinationPath, $image_name);


    	// update data pegawai
		DB::table('galang_dana')->where('id_galang_dana',$request->id)->update([
			'judul' => $request->judul,
			'gambar' => $image_name,
			'jumlah_dana' => str_replace('.', '', $request->dana),
			'durasi' => $request->hari,
			'alamat' => $request->alamat,
			'deskripsi' => $request->keterangan,
		]);

	}else{
		$messages = [
	    'required' => ':attribute Wajib diisi',
	    'min' => ':attribute harus diisi minimal :min karakter',
	    'max' => ':attribute harus diisi maksimal :max karakter',
	    'dana.required' => 'Jumlah Dana harus diisi minimal 1jt Maksimal 500jt',
	    
		];

	    $this->validate($request,[
	    'judul' => 'required',
	    'dana' => 'required',
	    'alamat' => 'required',
	    
		],$messages);

		DB::table('galang_dana')->where('id_galang_dana',$request->id)->update([
			'judul' => $request->judul,
			'jumlah_dana' => str_replace('.', '', $request->dana),
			'durasi' => $request->hari,
			'alamat' => $request->alamat,
			'deskripsi' => $request->keterangan,
			]);
	}
		// alihkan halaman ke halaman pegawai
		return redirect('/dashboard/galang_dana');
    	
	}

	public function perkembangan($id)
	{
		$id_user = Auth::user()->id;
		$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$perkembangan = DB::table('galang_dana')
		->where('galang_dana.id_galang_dana',$id)
			->get();

		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();


		return view('backend_user/perkembangan',['pengaturan' => $pengaturan, 'menu' => $menu,'perkembangan'=>$perkembangan, 'detail_saldo'=>$detail_saldo]);

	}	

	public function tambah_perkembangan(Request $request)
	{

		DB::table('perkembangan')->insert([
			'id_galang_dana' => $request->id,
			'tanggal' => $request->tanggal,
			'keterangan' => $request->keterangan,
		]);


		return redirect('/dashboard/galang_dana');

	}

	
		
	public function topup()
    {
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();
    	return view('backend_user/topup', ['pengaturan' => $pengaturan, 'menu' => $menu]);
	}


	public function submitTopup()
    {
      
        \DB::transaction(function(){

      $id_user = Auth::user()->id;
      $nama_user = Auth::user()->name;
      $email_user = Auth::user()->email;
            // Save donasi ke database
            $saldo = Saldo::create([
                'id_user' => $id_user,
                'jumlah' =>str_replace(".","",($this->request->jumlah)),
            ]);
 
            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $saldo->id,
                    'gross_amount'  => $saldo->jumlah,
                ],
                'customer_details' => [
                    'first_name'    => $nama_user,
                    'email'         => $email_user,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => 'saldo_'.$saldo->id,
                        'price'    =>  $saldo->jumlah,
                        'quantity' => 1,
                        'name'     => 'Topup Saldo'.$saldo->id,
                    ]
                ]
            ];
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $saldo->snap_token = $snapToken;
            $saldo->save();
 
            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });

        
 
        return response()->json($this->response);
    }



    public function riwayat_transaksi()
{
	$id_user = Auth::user()->id;
	$pengaturan = DB::table('pengaturan')->get();
	$menu = DB::table('menu')->get();

	$saldo = DB::table('saldo')
		->where('id_user',$id_user)
		->orderBy('id','desc')
		->paginate(5);

	$detail_saldo = DB::table('saldo')
	->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
	->where('id_user',$id_user)
	->where('status','sukses')
	->get();


	return view('backend_user/riwayat_transaksi',['pengaturan' => $pengaturan, 'menu' => $menu,'saldo'=>$saldo, 'detail_saldo'=>$detail_saldo]);

}

public function cari_riwayat(Request $request)
    {
    	$id_user = Auth::user()->id;
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$saldo = DB::table('saldo')
		->where('id_user',$id_user)
		->where('saldo.jumlah','LIKE', "%{$request->cari}%")
		->orderBy('id','desc')
		->paginate(5);

		$saldo->appends($request->only('cari'));

		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();


    	return view('backend_user/riwayat_transaksi',['pengaturan' => $pengaturan, 'menu' => $menu,'saldo'=>$saldo, 'detail_saldo'=>$detail_saldo]);
	}


 public function detail_saldo()
	{
		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

	return view('layout/backend_user', ['saldo' => $saldo]);
	
	}

	public function pencairan()
    {
    	$id_user = Auth::user()->id;
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$galang_dana = DB::table('galang_dana')
		->select(DB::raw('distinct *'), DB::raw('sum(distinct donasi.jumlah_dana) as terkumpul'),DB::raw('sum(pencairan_dana.jumlah) as telah_dicairkan'),DB::raw(('sum(distinct donasi.jumlah_dana)-sum(pencairan_dana.jumlah) as dapat_dicairkan'))
		)
		->join('pencairan_dana', 'galang_dana.id_galang_dana', '=', 'pencairan_dana.id_galang_dana')
		->join('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->where('galang_dana.id_user',$id_user)
		->where('donasi.status_dana','sukses')
		->groupBy('galang_dana.id_galang_dana')
		->get();


		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

		

    	return view('backend_user/pencairan', ['pengaturan' => $pengaturan, 'menu' => $menu,'galang_dana'=>$galang_dana,'detail_saldo'=>$detail_saldo]);
	}

public function semua_pencairan()
    {
    	$id_user = Auth::user()->id;
    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$galang_dana = DB::table('galang_dana')
		->join('pencairan_dana', 'galang_dana.id_galang_dana', '=', 'pencairan_dana.id_galang_dana')
		->where('galang_dana.id_user',$id_user)
		->groupBy('galang_dana.id_galang_dana')
		->get();


		$detail_saldo = DB::table('saldo')
		->select(DB::raw('SUM(jumlah) as jumlah_dana'), DB::raw('count(id) as total_topup') )
		->where('id_user',$id_user)
		->where('status','sukses')
		->get();

		

    	return view('backend_user/semua_pencairan_dana', ['pengaturan' => $pengaturan, 'menu' => $menu,'galang_dana'=>$galang_dana,'detail_saldo'=>$detail_saldo]);
	}



}