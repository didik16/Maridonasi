<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('pages/home');
});*/


Route::get('/notif', function () {
    return view('test_notif');
});

//BACKEND


//untuk test
Route::post('/gambar_post','BackendUserController@store_gambar');
Route::get('/gambar','BackendUserController@test_gambar');

//untuk test



Route::get('/','GalangDanaController@index');


//route CRUD
Route::get('/galangdana','GalangDanaController@list');


Route::get('/detail/{id}/{slug}','GalangDanaController@detail');


Route::post('/galangdana/store','GalangDanaController@store');
Route::get('/galangdana/list','GalangDanaController@list');

Route::get('/campaign', 'LoadMoreController@index');
Route::post('/campaign/load_data', 'LoadMoreController@load_data')->name('loadmore.load_data');




Auth::routes();
Route::post('/register','Auth\AuthController@postRegisters')->name('register');
Route::post('/login','Auth\AuthController@postLogin')->name('login');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');



//email
Route::get('/email', function () {
    return view('galang_dana/email/send_email');
});
Route::post('/sendEmail', 'GalangDanaController@kirim_email');





Route::group(['middleware' => ['auth','checkRole:admin']],function(){
	Route::get('/dashboard_admin','BackendController@index');
	Route::get('/dashboard_admin/galang_dana','BackendController@galang_dana');
	Route::get('/dashboard_admin/donasi','BackendController@donasi');


Route::get('/dashboard_admin/verifikasi_galang_dana','BackendController@verifikasi_galang_dana');
Route::get('/dashboard_admin/detail_galang_dana','BackendController@detail_galang_dana');

Route::get('/dashboard_admin/transaksi_saldo','BackendController@transaksi_saldo');

Route::get('/dashboard_admin/pencairan_dana','BackendController@pencairan_dana');

Route::get('/excel', 'BackendController@laporan_galang_dana');



});


Route::group(['middleware' => ['auth','checkRole:user']],function(){
	Route::get('/dashboard','BackendUserController@index');
	Route::get('/dashboard/donasi_saya','BackendUserController@donasi_saya');
	Route::get('/dashboard/cari_donasi','BackendUserController@cari_donasi_saya');

	//menu galang dana
	Route::get('/dashboard/galang_dana','BackendUserController@galang_dana');
	Route::get('/dashboard/cari_galang_dana','BackendUserController@cari_galang_dana');
	Route::get('/dashboard/buat_galang_dana','BackendUserController@buat_galang_dana');
	Route::post('/dashboard/store_galang_dana','BackendUserController@store_galang_dana');
	Route::post('/dashboard/image_upload_ckeditor', 'BackendUserController@upload_ckeditor')->name('upload_ckeditor');
	Route::post('/dashboard/image_upload_tiny', 'BackendUserController@proses_upload');

	Route::get('/dashboard/edit_galang_dana/{id}/{slug}','BackendUserController@edit_galang_dana');
	Route::post('/dashboard/update_galang_dana','BackendUserController@update_galang_dana');

	Route::get('/dashboard/perkembangan/{id}','BackendUserController@perkembangan');
	Route::post('/dashboard/tambah_perkembangan','BackendUserController@tambah_perkembangan');

	Route::get('/dashboard/semua_pencairan/','BackendUserController@semua_pencairan');
	Route::get('/dashboard/pencairan/','BackendUserController@pencairan');
	
	Route::get('/donasi/{id}/{slug}','DonasiController@donasi');

	//topup
	Route::get('/topup','BackendUserController@topup');
	Route::post('/topup/store', 'BackendUserController@submitTopup')->name('topup.store');


	//riwayat transaksi
	Route::get('/dashboard/riwayat_transaksi','BackendUserController@riwayat_transaksi');
	Route::get('/dashboard/cari_riwayat','BackendUserController@cari_riwayat');


	//midtrans
	Route::post('/finish', function(){
    	return redirect()->route('welcome');
	})->name('donation.finish');
	Route::post('/donation/store', 'DonasiController@submitDonation')->name('donation.store');
	Route::post('/notification/handler', 'DonasiController@notificationHandler')->name('notification.handler');

	
	
});


	//Route::post('/donation/store', 'DonasiController@store')->name('donation.store');



 

//DATA ADMIN
Route::get('/admin', function(){
    return view('admin');
})->name('adminpage');
Route::get('admin-login','Auth\AdminLoginController@showLoginForm');
Route::post('admin-login', ['as' => 'admin-login', 'uses' => 'Auth\AdminLoginController@login']);



/*//route CRUD
Route::get('/pegawai','PegawaiController@index');

//tambah CRUD
Route::get('/pegawai/tambah','PegawaiController@tambah');

Route::post('/pegawai/store','PegawaiController@store');

Route::get('/pegawai/edit/{id}','PegawaiController@edit');

Route::post('/pegawai/update','PegawaiController@update');

Route::get('/pegawai/hapus/{id}','PegawaiController@hapus');


Route::get('nama', function () {
    $mahasiswa = [
    	'MAde',
    	'Joni',
    	'Ahh'
    ];
    return view('pages/home', compact('mahasiswa'));
});

*/


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
