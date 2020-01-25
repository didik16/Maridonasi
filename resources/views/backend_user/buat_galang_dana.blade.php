@extends('layout.backend_user')
@section('title', 'Buat Galang Dana')
@section('judul', 'Buat Galang Dana')
@section('galang_dana_nav', 'active-nav')

@section('content')




    <img src="{{ asset('assets/img/charity.jpg') }}" alt="charity" id="charity" style="width:100%;margin-bottom: 25px">


 @if ($errors->has())
  
   @foreach ($errors->all() as $error)
    {{ $error }}  
   @endforeach
  
  @endif
  

    <form action="/galangdana/store" method="post">
        {{ csrf_field() }}





        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputEmail4">Nama</label>
            <input type="input" class="form-control" name="nama" placeholder="Nama Lengkap">
          </div>
          <div class="form-group col-md-4">
            <label for="inputPassword4">Usia</label>
            <input type="number" class="form-control" name="usia" placeholder="Usia">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Janis Penyakit</label>
          <input type="text" class="form-control" name="penyakit" placeholder="Kanker, Kaki Gajah, dll">
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="inputEmail4">Kebutuhan Dana</label>
            <input type="input" class="form-control" name="dana" placeholder="Maksimal 500 Juta">
          </div>
          <div class="form-group col-md-4">
            <label for="inputPassword4">Batas Hari</label>
            <input type="number" class="form-control" name="durasi" placeholder="Maksimal 150 Hari">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress2">Alamat</label>
          <input type="text" class="form-control" name="alamat" placeholder="Isikan Alamat Rumah Pasien">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputState">Provinsi</label>
            <select name="provinsi" class="form-control">
              <option selected>Pilih Provinsi</option>
              <option>Bali</option>
              <option>Sumatra</option>
              <option>Jawa Barat</option>
              <option>Jawa Tengah</option>
              <option>Jawa Timur</option>
              <option>Papua</option>
              <option>NTT</option>
              <option>NTB</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="inputCity">Kecamatan</label>
            <input type="text" class="form-control" name="kecamatan">
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">Kode Pos</label>
            <input type="text" class="form-control" name="kodepos">
          </div>
        </div>
        <div class="form-group">
          <label for="exampleTextarea">Keterangan</label>
          <textarea class="form-control" name="keterangan" rows="3"></textarea>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="cek">
            <label class="form-check-label" for="gridCheck">
              Setuju <a href="#">Syarat & Ketentuan</a>
            </label>
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary" style="width: 100%">Buat Penggalangan Dana</button>
      </form>

      

@endsection