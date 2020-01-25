<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Model\Donasi;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;


class TopupController extends Controller
{

	/**
     * Make request global.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
 
    /**
     * Class constructor.
     *
     * @param \Illuminate\Http\Request $request User Request
     *
     * @return void
     */
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
    	
    }

    public function donasi($id)
    {

    	$donasi = Donasi::all();

    	$pengaturan = DB::table('pengaturan')->get();
		$menu = DB::table('menu')->get();

		$detail = DB::table('galang_dana')
		->select('galang_dana.id_galang_dana', 'galang_dana.tgl_galang_dana','galang_dana.gambar',  'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.deskripsi', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status', DB::raw('SUM(donasi.jumlah_dana) as terkumpul'),  DB::raw('TIMESTAMPDIFF(DAY, CURDATE(), DATE(galang_dana.tgl_galang_dana) + INTERVAL 30 DAY) AS sisa_hari'), DB::raw('count( distinct donasi.id_user) as jumlah_donatur') )
		->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
		->where('galang_dana.id_galang_dana',$id)
		->groupBy('galang_dana.id_galang_dana','galang_dana.tgl_galang_dana', 'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status','galang_dana.gambar')
		->get();

		return view('galang_dana/donasi', ['pengaturan' => $pengaturan, 'menu' => $menu, 'detail'=> $detail ,'donasi' => $donasi]);
    }


/*


    public function donasi_store() {
    	$donation = Donasi::create([
                'id_user' => 1,
                'id_galang_dana' => 1,
                'jumlah_dana' =>floatval($this->request->jumlah_dana),
                'anonim' => $this->request->anonim,
                'komentar' => $this->request->komentar,
            ]);
    }



    public function store(Request $request)
	{
	// insert data ke table pegawai
	DB::table('donasi')->insert([
		'id_user' => 1,
		'id_galang_dana' => 1,
		'jumlah_dana' => floatval($this->request->jumlah_dana),
		'anonim' => $this->request->anonim,
		'komentar' => $this->request->komentar,
	]);


	// Save donasi ke database
            $donation = Donasi::create([
                'id_user' => 1,
                'id_galang_dana' => 1,
                'jumlah_dana' =>floatval($this->request->jumlah_dana),
                'anonim' => $this->request->anonim,
                'komentar' => $this->request->komentar,
            ]);
            $donation->save();

	// alihkan halaman ke halaman pegawai
	//return redirect('/pegawai');

            //return dd( $this->request->komentar);
 
	}*/



    /**
     * Submit donation.
     *
     * @return array
     */
    public function submitDonation()
    {
      

/*    	$user = DB::table('users')
		->select('users.name','users.email')
		->where('users.id_user',$id_user)
		->get();


		foreach ($user as $user) {
			# code...
		}*/

        \DB::transaction(function(){

          $id_user = Auth::user()->id;
      $nama_user = Auth::user()->name;
      $email_user = Auth::user()->email;
            // Save donasi ke database
            $donation = Donasi::create([
                'id_user' => $id_user,
                'id_galang_dana' => $this->request->id_galang_dana,
                'jumlah_dana' =>str_replace(".","",($this->request->jumlah_dana)),
                'anonim' => $this->request->anonim,
                'komentar' => $this->request->komentar,
            ]);
 
            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $donation->id,
                    'gross_amount'  => $donation->jumlah_dana,
                ],
                'customer_details' => [
                    'first_name'    => $nama_user,
                    'email'         => $email_user,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => 'galang_dana_'.$this->request->id_galang_dana,
                        'price'    =>  $donation->jumlah_dana,
                        'quantity' => 1,
                        'name'     => 'Donasi '.$this->request->judul,
                    ]
                ]
            ];
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();
 
            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });

        
 
        return response()->json($this->response);
    }
 
    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     * 
     * @return void
     */
    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();
        \DB::transaction(function() use($notif) {
 
          $transaction = $notif->transaction_status;
          $type = $notif->payment_type;
          $orderId = $notif->order_id;
          $fraud = $notif->fraud_status;
          $donation = Donation::findOrFail($orderId);
 
          if ($transaction == 'capture') {
 
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
 
              if($fraud == 'challenge') {
                // TODO set payment status in merchant's database to 'Challenge by FDS'
                // TODO merchant should decide whether this transaction is authorized or not in MAP
                // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                $donation->setPending();
              } else {
                // TODO set payment status in merchant's database to 'Success'
                // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                $donation->setSuccess();
              }
 
            }
 
          } elseif ($transaction == 'settlement') {
 
            // TODO set payment status in merchant's database to 'Settlement'
            // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
            $donation->setSuccess();
 
          } elseif($transaction == 'pending'){
 
            // TODO set payment status in merchant's database to 'Pending'
            // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
            $donation->setPending();
 
          } elseif ($transaction == 'deny') {
 
            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
            $donation->setFailed();
 
          } elseif ($transaction == 'expire') {
 
            // TODO set payment status in merchant's database to 'expire'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
            $donation->setExpired();
 
          } elseif ($transaction == 'cancel') {
 
            // TODO set payment status in merchant's database to 'Failed'
            // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
            $donation->setFailed();
 
          }
 
        });
 
        return;
    }

}

