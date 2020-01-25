@extends('layout.app')
@section('title', 'Galang Dana')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/custom/style-home.css') }}">



<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top:-57px">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('assets/img/galang_dana/1.jpg') }}" alt="First slide">
      <div class="hitam-trans"></div>
      	<div class="carousel-caption d-none d-md-block">
		    <h3>Bantu Satrio Sembuh dari Kanker Prostat</h3>
		    <p>lorem ipsun blabla hdsid ddisen wewujnwe wejiwe</p>
		    <button type="button" class="btn btn-outline-light">DONASI</button>
		</div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('assets/img/galang_dana/2.jpg') }}" alt="Second slide">
      <div class="hitam-trans"></div>
      	<div class="carousel-caption d-none d-md-block">
		    <h5>Test</h5>
		    <p>lorem ipsun blabla hdsid ddisen wewujnwe wejiwe</p>
		</div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('assets/img/galang_dana/3.jpg') }}" alt="Third slide">
      <div class="hitam-trans"></div>
      <div class="carousel-caption d-none d-md-block">
		    <h5>Test</h5>
		    <p>lorem ipsun blabla hdsid ddisen wewujnwe wejiwe</p>
		</div>
    </div>
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
						<img src="{{ asset('assets/img/icon/users.svg') }}" alt="users" style="width: 100%; height: auto;" class="img-responsive pull-right">
					</div>
					<div class="col-8">
						<ul>
							<li>{{ $pp->jumlah_galang_dana }}</li>
							<li>Donatur</li>
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
							<li>{{ $pp->total_dana_terkumpul }}</li>
							<li>Donatur</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="row">
					<div class="col-4">
						<img src="{{ asset('assets/img/icon/activities.svg') }}" alt="activities" style="width: 100%; height: auto;" class="img-responsive pull-right">
					</div>
					<div class="col-8">
						<ul>
							<li>{{ $pp->jumlah_donatur }}</li>
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
	@foreach($galang_dana as $galang)
	<div class="row" style="margin-bottom: 20px">
			<div class="col-md-4">
				<img src="{{ asset('assets/img/'.$galang->gambar) }}" alt="logo" id="logo_head" style="width:100%;">
			</div>
			<div class="col-md-8">
				<h2 >{{ $galang->judul }}</h2>
				 <h4 style="font-size: 18px">{{ $galang->tgl_galang_dana }}</h4>
				 <h4 style="font-size: 18px">{{ "Dana Dibutuhkan : ".number_format($galang->jumlah_dana) }}</h4>
				<h4 style="font-size: 18px">{{ "Total Donasi : ".number_format($galang->terkumpul) }}</h4>
				<h4 style="font-size: 18px;color:#a3a3a3;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical; overflow: hidden;text-align: justify;">{{ $galang->deskripsi }}</h4>
				<div class="progress" style="margin-bottom: 10px">
					<div class="progress-bar" role="progressbar" style="width: {{ ($galang->terkumpul / $galang->jumlah_dana*100) }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<a href="#" class="btn btn-primary btn-lg active " role="button" aria-pressed="true">DONASI SEKARANG</a>
			</div>

	</div>
	@endforeach
</div>


@endsection

<script type="text/javascript">
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
   
  } else {
    navbar.classList.remove("sticky");

  }
}
</script>