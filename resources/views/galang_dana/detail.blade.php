@extends('layout.app')
@section('title', 'Galang Dana')

@section('content')

<style type="text/css">
	a {
		color: black;
	}
</style>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5df2d47d02b11200120138e0' async='async'></script>


<div class="container">
	@foreach($detail as $detail)
	<img src="{{ asset('assets/img/galang_dana/'.$detail->gambar) }}" width="100%" style="margin-bottom: 25px">
	
	<div class="row">
		<div class="col-md-8">
			<H1>{{ $detail->judul }}</H1>

			<ul class="nav nav-tabs nav-justified" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" href="#deskripsi" role="tab" data-toggle="tab">Deskripsi</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#perkembangan" role="tab" data-toggle="tab">Perkembangan</a>
			  </li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div role="tabpanel" class="tab-pane  active" id="deskripsi" style="margin: 15px 0px">
			  	<?php echo $detail->deskripsi ?>

			  	<br>

			  </div>
			  
			  <div role="tabpanel" class="tab-pane " id="perkembangan">
			  	<ul style="margin-top: 10px;">
			  		<hr>
			  		@foreach($perkembangan as $p)
			  		<li>
			  			<p style="font-weight: bold">{{ $p->tanggal}}</p>
			  			<p><?php echo $p->keterangan ?></p>
			  			<hr>
			  		</li>
			  		@endforeach
			  	</ul>
			  </div>
			  
			</div>
		</div> <!-- Tutup Col-MD-8 -->

		<div class="col-md-4">
			<div class="row" style="margin-bottom: 15px">
				<div class="col-md-3 col-3">
					<img src="https://images.jg-cdn.com/image/8e00f08f-7572-4f7d-a623-6e3741b0659c.jpg?template=size75x75face" style="border-radius: 50%;width: 100%">
				</div>
				<div class="col-md-9 col-9" style="padding : 0">
					<h4 style="font-weight: bolder;">Didik Ariyana</h4>
				</div>
			</div>



			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-8">
					<p style="font-weight: bold;font-size: 18px;color: #fd3300">{{ 'Rp. '. number_format($detail->terkumpul) }}</p>
					<p style="font-size: 12px">Dari Rp. {{ number_format($detail->jumlah_dana) }} </p>
				</div>
				<div class="col-md-4" style="text-align: right;">
					<p style="font-weight: bold;font-size: 15px">
						<?php if($detail->sisa_hari >0 ){ 
							echo $detail->sisa_hari;
						}else{
							echo '0';} 
						?> Hari</p>
					<p style="font-size: 12px">Sisa Hari</p>
				</div>
			</div>

			<div class="progress" style="margin-bottom: 10px;height: 1rem">
				
					@if(floor($detail->terkumpul / $detail->jumlah_dana*100) >=100)
						<div class="progress-bar" role="progressbar" style="width: {{ ($detail->terkumpul / $detail->jumlah_dana*100) }}%;padding:0px 5px;background: #ff2525" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
					 	100% 
					 </div>
					@else
						<div class="progress-bar" role="progressbar" style="width: {{ ($detail->terkumpul / $detail->jumlah_dana*100) }}%;padding:0px 5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						<?= floor($detail->terkumpul / $detail->jumlah_dana*100).'%' ?>
					 </div>
					@endif

				
			</div>
			<a href="{{'/donasi/'.$detail->id_galang_dana.'/'.$detail->slug}}" class="tombol-n1" style="margin: 0 auto;display: table;font-size: 20px;width: 100%;text-align: center;">DONASI</a>

			<div class="row" style="margin-top: 15px">
				<div class="col-md-7">
					<p style="font-size: 20px;font-weight: bold;">Donatur</p>
				</div>
				<div class="col-md-5" style="text-align: right;">
					@foreach($jml_donatur as $jml_donatur)
					<p>{{ $jml_donatur->jml }} Orang</p>
					@endforeach
				</div>
			</div>

			@foreach($donatur as $donatur)

			<?php if($donatur->anonim != "Y") { ?>

				<div class="row" style="margin: 15px 0px;background: #f5f3f3;padding: 10px 0px;">
					<div class="col-md-3">
						<?php if($donatur->foto == NULL){ ?>
							<img src="{{ asset('assets/img/user/user.webp') }}" style="border-radius: 50%;width: 100%">
						<?php } else { ?>
							<img src="{{ asset('assets/img/user/'.$donatur->foto) }}" style="border-radius: 50%;width: 100%">
						<?php } ?>
					</div>
					<div class="col-md-6" style="padding: 0">
						<h5 style="font-weight: bolder;margin: 0">{{ ucwords($donatur->name) }}</h5>
						<p style="font-size: 12px">Rp. {{ number_format($donatur->jumlah_dana)}}</p>
						<p style="font-size: 10px">{{ $donatur->komentar}}</p>
					</div>
					<div class="col-md-3" style="text-align: right;">
						<p style="font-size: 10px">{{ $donatur->tgl_donasi}}</p>
					</div>
				</div>

			<?php } else { ?>
				<div class="row" style="margin: 15px 0px;background: #f5f3f3;padding: 10px 0px;">
					<div class="col-md-3">
						<img src="{{ asset('assets/img/user/user.webp') }}" style="border-radius: 50%;width: 100%">
					</div>
					<div class="col-md-6" style="padding: 0">
						<h5 style="font-weight: bolder;margin: 0">Anonim</h5>
						<p style="font-size: 12px">Rp. {{ number_format($donatur->jumlah_dana)}}</p>
						<p style="font-size: 10px">{{ $donatur->komentar}}</p>
					</div>
					<div class="col-md-3" style="text-align: right;">
						<p style="font-size: 10px">{{ $donatur->tgl_donasi}}</p>
					</div>
				</div>

			<?php } ?>


			@endforeach
		</div>
	</div>
</div>



	

<!-- <div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
</div> -->




	@endforeach
</div>

<!-- <script>
  $(document).ready(function() {
    $('.imgSmall img').click(function(event) {
    	console.log("Hai")
      var id = $(this).data('id');
      var src = $(this).attr('src');
      var img = $('#imgBig img');

      img.fadeOut('fast', function() {
        $(this).attr({src: src,});
        $(this).fadeIn('fast');
      });
    });
  });
</script> -->




@endsection