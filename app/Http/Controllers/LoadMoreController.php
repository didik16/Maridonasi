<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoadMoreController extends Controller
{
    function index()
    {
      $pengaturan = DB::table('pengaturan')->get();
      $menu = DB::table('menu')->get();

      return view('galang_dana/load_more',['pengaturan' => $pengaturan,'menu'=>$menu]);
    }

    function load_data(Request $request)
    {
      if($request->ajax())
      {
        if($request->id > 0)
        {
          $data =  DB::table('galang_dana')
            ->select('galang_dana.id_galang_dana','galang_dana.slug', 'galang_dana.tgl_galang_dana','galang_dana.gambar',  'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status', DB::raw('SUM(donasi.jumlah_dana) as terkumpul'),  DB::raw('TIMESTAMPDIFF(DAY, CURDATE(), DATE(galang_dana.tgl_galang_dana) + INTERVAL 30 DAY) AS sisa_hari'), DB::raw('count( distinct donasi.id_user) as jumlah_donatur') )
            ->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
            ->where('galang_dana.id_galang_dana', '<', $request->id)
            ->groupBy('galang_dana.id_galang_dana','galang_dana.tgl_galang_dana', 'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status','galang_dana.gambar')
            ->where('status','YES')
            ->orderBy('id_galang_dana', 'DESC')
            ->limit(6)
            ->get();
        } else {
          $data = DB::table('galang_dana')
            ->select('galang_dana.id_galang_dana','galang_dana.slug', 'galang_dana.tgl_galang_dana','galang_dana.gambar',  'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status', DB::raw('SUM(donasi.jumlah_dana) as terkumpul'),  DB::raw('TIMESTAMPDIFF(DAY, CURDATE(), DATE(galang_dana.tgl_galang_dana) + INTERVAL 30 DAY) AS sisa_hari'), DB::raw('count( distinct donasi.id_user) as jumlah_donatur') )
            ->leftJoin('donasi', 'galang_dana.id_galang_dana', '=', 'donasi.id_galang_dana')
            ->groupBy('galang_dana.id_galang_dana','galang_dana.tgl_galang_dana', 'galang_dana.judul', 'galang_dana.jumlah_dana', 'galang_dana.durasi', 'galang_dana.deskripsi', 'galang_dana.status','galang_dana.gambar')
            ->where('status','YES')
            ->orderBy('id_galang_dana', 'DESC')
              ->limit(6)
            ->get();
        }
        $output = '';
        $last_id = '';
        
        if(!$data->isEmpty())
        { ?>
          <div class="col-md-12">
           <div class="row" style="margin-bottom: 20px">
            <?php
          foreach($data as $row){ ?>
            
      <div class="col-md-4" style="margin:10px 0px">
        <a href="<?= '/detail/'.$row->id_galang_dana.'/'.$row->slug ?>" style="color: black;text-decoration: none;">
        <div class="box">
          <div class="box-img" style="background-repeat: no-repeat;background-position: center center;background-size: cover;padding-bottom: 56%;min-width: 100%;background-image: url( <?= asset('assets/img/galang_dana/'.$row->gambar) ?> );">

            <div class="donatur">
              <?= $row->jumlah_donatur.' Donatur'?>
            </div>

                  </div>
                  <div class="box-text">
                    <div class="box-text judul">
              <h4 ><?= $row->judul ?></h4>
            </div>
            <div class="progress" style="margin-bottom: 10px">
              <div class="progress-bar" role="progressbar" style="width: <?= ($row->terkumpul / $row->jumlah_dana*100) ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
              </div>
            </div>
            <div class="row" style="
            margin-bottom: 10px">
              <div class="col-md-8">
                <p style="font-weight: bold;font-size: 15px"><?= 'Rp. '. number_format($row->terkumpul) ?></p>
                <p style="font-size: 12px">Dari Rp. <?= number_format($row->jumlah_dana) ?> </p>
              </div>
              <div class="col-md-4" style="text-align: right;">
                <p style="font-weight: bold;font-size: 15px">
                  <?php if($row->sisa_hari >0 ){ 
                    echo $row->sisa_hari;
                  }else{
                    echo '0';} 
                  ?> Hari</p>
                <p style="font-size: 12px">Sisa Hari</p>
              </div>
            </div>
          </div>
        </div>
        </a>
      </div>

          <?php
            $last_id = $row->id_galang_dana;
          }?>

      </div>
      </div>

          <div id="load_more">
            <button
              type="button"
              name="load_more_button"
              class="btn btn-success form-control"
              data-id="<?=$last_id;?>"
              id="load_more_button"
              style="background:linear-gradient(45deg,#eb6565 0%, #a33333 100%);border:none;">
              Lainnya
            </button>
          </div> 
        <?php } else { ?>
          <div id="load_more">
            <button
              type="button"
              name="load_more_button"
              class="btn btn-info form-control"
              style="background:linear-gradient(45deg,#eb6565 0%, #a33333 100%);border:none;">
              Tidak ada data ditemukan
            </button>
          </div>
        <?php }
      }
    }
}

?>