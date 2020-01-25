@extends('layout.backend_admin')
@section('title', 'Galang Dana')

@section('judul', 'Dashboard Admin')
@section('dashboard_nav', 'active-nav')
@section('content')

<div class="row">
	@foreach($detail as $detail)
	<div class="col-lg-4 col-xs-6" style="padding: 5px"> 
		<div class="small-box bg-yellow">
			<div class="inner">
	 			<h3 style="color: white">{{$detail->jumlah_donatur}}</h3>
				<p style="color: white">Total Donatur</p>
			</div>
			<div class="icon">
				<i class="fas fa-hand-holding-heart" aria-hidden="true"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-xs-6" style="padding: 5px">
		<div class="small-box bg-aqua">
			<div class="inner">
	 			<h3 style="color: white">{{ 'Rp.' .number_format($detail->total_dana_terkumpul)}}</h3>
				<p style="color: white">Total Didonasikan</p>
			</div>
			<div class="icon">
				<i class="fas fa-money-bill-wave"></i>
			</div>
		</div>
	</div>
		<div class="col-lg-4 col-xs-6" style="padding: 5px">
		<div class="small-box bg-red1">
			<div class="inner">
	 			<h3 style="color: white">{{$detail->jumlah_galang_dana}}</h3>
				<p style="color: white">Total Galang Dana</p>
			</div>
			<div class="icon">
				<i class="fas fa-child" aria-hidden="true"></i>
			</div>
		</div>
	</div>
	@endforeach
</div>

@endsection