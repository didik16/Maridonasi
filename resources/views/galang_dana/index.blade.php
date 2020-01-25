@extends('layout.app')
@section('title', 'Galang Dana')

@section('content')
@section('script')
<link rel="stylesheet" href="{{ asset('assets/css/custom/style-home.css') }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endsection


<?php $index_slide = 0; ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top:-57px">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
  	@foreach($slider as $slide)
    <div class="carousel-item <?php if($index_slide == 0){echo " active";}?>">


<div class="box-img" style="background-repeat: no-repeat;background-position: center center;background-size: cover;padding-bottom: 40%;min-width: 100%;background-image: url( {{ asset('assets/img/galang_dana/'.$slide->gambar) }} );"></div>

      <div class="hitam-trans"></div>
      	<div class="carousel-caption d-none d-md-block">
		    <h2>{{ $slide->judul}}</h2>
		    <p style="margin-bottom: 10px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">{{ $slide->deskripsi}}</p>
		    <button type="button" class="btn btn-outline-light">DONASI</button>
		</div>
    </div>
     <?php $index_slide++ ?>
    @endforeach
  </div>
 
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="container">

	<div class="info-panel col-md-10 col-md-offset-1">
		@foreach($info_atas as $pp)
		<div class="row">
			<div class="col-4">
				<div class="row">
					<div class="col-4">
						<img src="{{ asset('assets/img/icon/activities.svg') }}" alt="users" style="width: 100%; height: auto;" class="img-responsive pull-right">
					</div>
					<div class="col-8">
						<ul>
							<li><h3 style="margin-bottom: 0">{{ $pp->jumlah_galang_dana }}</h3></li>
							<li>Galang Dana</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="row">
					<div class="col-4">
						<img src="{{ asset('assets/img/icon/organizations.svg') }}" alt="organizations" style="width: 100%; height: auto;" class="img-responsive pull-right">
					</div>
					<div class="col-8">
						<ul>
							<li><h4 style="margin-bottom: 0">{{ 'Rp. '. number_format($pp->total_dana_terkumpul) }}</h4></li>
							<li>Terkumpul</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="row">
					<div class="col-4">
						<img src="{{ asset('assets/img/icon/users.svg') }}" alt="activities" style="width: 100%; height: auto;" class="img-responsive pull-right">
					</div>
					<div class="col-8">
						<ul>
							<li><h3 style="margin-bottom: 0">{{ $pp->jumlah_donatur }}</h3></li>
							<li>Donatur</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>


<div class="container" style="padding: 20px;margin-top: 100px">
	<div class="col-md-12" data-aos="fade-up" data-aos-once="true" data-aos-delay="200" data-aos-duration="2000">
		<div class="widget-title">
			<center>
        		<h1 style="color:white;background:linear-gradient(45deg,#eb6565 0%, #a33333 100%);display:inline-block;padding:5px 20px;margin:0px;border-radius: 10px 10px 0px 0px">Mari Bantu Mereka</h1>
        	</center>
      	</div>
		<div class="row" style="margin-bottom: 20px">
	@foreach($galang_dana as $galang)
			
			
			<div class="col-md-4" style="margin:10px 0px">
				<a href="{{ '/detail/'.$galang->id_galang_dana }}/{{ $galang->slug }}" style="color: black;text-decoration: none;">
				<div class="box">
					<div class="box-img" style="background-repeat: no-repeat;background-position: center center;background-size: cover;padding-bottom: 56%;min-width: 100%;background-image: url( {{ asset('assets/img/galang_dana/'.$galang->gambar) }} );">

						<div class="donatur">
							{{ $galang->jumlah_donatur.' Donatur'}}
						</div>

	                </div>
	                <div class="box-text">
		                <div class="box-text judul">
							<h4 >{{ $galang->judul }}</h4>
						</div>
						<div class="progress" style="margin-bottom: 10px">
							@if(floor($galang->terkumpul / $galang->jumlah_dana*100) >=100)
							<div class="progress-bar" role="progressbar" style="width: {{ ($galang->terkumpul / $galang->jumlah_dana*100) }}%;background: #ff2525" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">	
							 </div>
							@else
								<div class="progress-bar" role="progressbar" style="width: {{ ($galang->terkumpul / $galang->jumlah_dana*100) }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
							 </div>
							@endif


						</div>
						<div class="row" style="
						margin-bottom: 10px">
							<div class="col-md-8">
								<p style="font-weight: bold;font-size: 15px">{{ 'Rp. '. number_format($galang->terkumpul) }}</p>
								<p style="font-size: 12px">Dari Rp. {{ number_format($galang->jumlah_dana) }} </p>
							</div>
							<div class="col-md-4" style="text-align: right;">
								<p style="font-weight: bold;font-size: 15px">
									<?php if($galang->sisa_hari >0 ){ 
										echo $galang->sisa_hari;
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
		
		@endforeach
		</div>
		<a href="/campaign" class="tombol-n1" style="margin: 0 auto;display: table;font-size: 20px;">LIHAT SEMUA GALANGAN DANA</a>
	</div>

</div><!-- tutup container  -->



<div class="container-fluid" style="padding: 0;">
	<div class="col-md-12" style="background:url(../assets/img/icon/gambar-mari.jpeg);background-size: cover;background-position: bottom center;background-repeat: no-repeat;padding: 0;position: relative; background-attachment: fixed;">
	
	<div class="hitam-trans" ></div>
	<div class="container text-center" style="padding: 50px;position: relative;">
			<h1 style="color: white;margin-bottom: 25px">Mari jadi relawan untuk mereka</h1>
			
			<div class="row justify-content-center">
				<div class="col-md-6 text-center">
					<div class="row ">
						<div class="col-md-6">
							<a href="/campaign" class="tombol-n1" style="margin: 0 auto;display: table;font-size: 20px;width: 100%;text-align: center;">GALANG DANA</a>
						</div>
						<div class="col-md-6">
							<a href="/campaign" class="tombol-n1" style="margin: 0 auto;display: table;font-size: 20px;width: 100%;text-align: center;background: linear-gradient(45deg,#ffa638 0%, #ff5656 100%)!important">DONASI</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="container-fluid justify-content-center" id="kenapa" style="background: white;padding: 0;">
	<div class="container" style="padding: 20px 0px">
		<div class="text-center" style="margin-top: 15px">
		    <div class="title" style="font-size: 32px;color: #0B5180;font-weight: bold;font-family:"bloggersansreg", helvetica, arial;">
		    	Mengapa donasi lewat MariDonasi.com ?
			</div>
		    <div class="desc">
		    	MariDonasi memudahkan Anda dalam melakukan donasi kepada orang yang membutuhkan, namun mengapa harus Maridonasi.com ?
		    </div>
		</div><!-- END SECTION TITLE -->
		<div class="sec-body">
		    <div class="row justify-content-center" >
		        <div class="col-md-4 col-sm-6 col-12 text-center" data-aos="fade-up">
		            <img src="{{ asset('assets/img/icon/kenapa1.png') }}" alt="">
		            <h4>Tepat Sasaran</h4>
		            <p>Donasi yang terkumpul melalui Maridonasi.com akan disalurkan secara langsung ke rumah sakit atau ke keluarga pasien.</p>
		        </div>
		        <div class="col-md-4 col-sm-6 col-12 text-center" data-aos="fade-up" data-aos-delay="300">
		            <img src="{{ asset('assets/img/icon/kenapa2.png') }}" alt="">
		            <h4>Transparan</h4>
		            <p>MariDonasi.com sangat transparan dalam mengelola keuangan. Setiap transaksi dan distribusi donasi dapat dilihat melalui halaman transparansi.</p>
		        </div>
		        <div class="col-md-4 col-sm-6 col-12 text-center" data-aos="fade-up" data-aos-delay="600">
		            <img src="{{ asset('assets/img/icon/kenapa3.png') }}" alt="">
		            <h4>Update Pasien</h4>
		            <p>MariDonasi.com akan memberikan update mengenai keadaan pasien setelah menerima penanganan medis secara berkala kepada donatur.</p>
		        </div>
		    </div>
		</div>
	</div>
</div>

<script>
  AOS.init();
</script>


@endsection



