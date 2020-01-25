@extends('layout.backend_admin')
@section('title', 'Galang Dana')

@section('judul', 'Donasi')
@section('donasi_nav', 'active-nav')
@section('content')

<div class="row">
	<div class="col-md-8" >
		<form action="/dashboard_admin/cari_donasi" method="get"> 
			<div class="input-group mb-3">
			  <input type="text" class="form-control" name="cari" placeholder="Cari Donasi" aria-describedby="basic-addon2"> 
			  <div class="input-group-append">
			    <button class="btn btn-outline-secondary" type="submit">Cari</button>
			  </div>
			</div>
		</form>


		@foreach($donasi as $data_donasi) 
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-3">
				<div class="box-img" style="background-repeat: no-repeat;background-position: center center;background-size: cover;padding-bottom: 56%;min-width: 100%;background-image: url( {{ asset('assets/img/galang_dana/'.$data_donasi->gambar )}} );">
				</div>
			</div>
			<div class="col-md-9" style="padding: 0">
				<h5>{{ $data_donasi->judul}}</h5>
				<p style="font-size: 12px;display: unset">{{ $data_donasi->tgl_donasi}} | Rp. {{ number_format($data_donasi->jumlah_dana) }} | User : {{ $data_donasi->id_user}} </p>
				@if($data_donasi->status_dana == "sukses") 
				<p style="background: green;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">SUKSES</p>
				@elseif($data_donasi->status_dana == "pending") 
				<p style="background: #ffc800;padding: 5px;display: unset;border-radius: 5px;color: black;font-size: 10px">PENDING</p>
				@else 
				<p style="background: red;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">GAGAL</p>
				@endif

			</div>
		</div>
		@endforeach
		{{ $donasi->links() }} <!-- ini untuk fungsi pagination -->
	</div>
</div>

@endsection