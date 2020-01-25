<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GalangDana extends Model
{
    protected $table = 'galang_dana';
    protected $primaryKey = 'id_galang_dana';
     protected $fillable = ['id_galang_dana','id_user','tgl_galang_dana','judul','jumlah_dana','durasi','alamat','deskripsi','slug','status'];
    protected $guarded = [];


/*    public static function getJumlahTamuJenisPerTahun(){


    	$tahun_awal = date('Y') - 5;
    	$tahun_akhir = date('Y');

    	$category = [];

    	$series[0]['name'] = 'Donasi';


    	$j = 0;
    	for ($i=$tahun_awal; $i <= $tahun_akhir ; $i++) { 
    		$category[] = $i;

    		$series[0]['data'][] = Self::where('jenis_tamu', '=', 'dalam negeri')->where('tgl_kunjungan','like', $i.'%')->count();
    	}

    	return ['category' => $category, 'series' => $series];
    }*/
    
}