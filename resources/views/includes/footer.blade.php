<div class="footer">
	<div class="container" style="padding:20px">
		<div class="row">
			@foreach($pengaturan as $pengaturan)
			<div class="col-md-7" style="text-align: justify;color: white">
				<div class="row">
					<div class="col-md-12" style="width: 100%">
						<img src="{{ asset('assets/img/icon/logopanjangputih.png') }}" alt="logo" id="logo_head" style="width:50%;margin-bottom: 15px;float: left" >
					</div>
				<div class="col-md-12">
					<?php echo $pengaturan->informasi ?>
				</div>
				</div>
<!-- 				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5577.504430944205!2d115.16824114771347!3d-8.701880904893171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd246dc94e3f821%3A0xab55ebb737c9db84!2sLegian%20Art%20Painting!5e0!3m2!1sid!2sid!4v1574316689395!5m2!1sid!2sid" width="100%" height="auto" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
			</div>
			
			<div class="col-md-2" style="text-align: left;">
				<h3>MENU</h3>
				<ul style="padding: 0">
				@foreach($menu as $menu)
				<li style="list-style: none;">
					<a style="text-decoration: none;color: white" href="{{ $menu->link}}">{{ $menu->judul}}</a></li>
				@endforeach
				</ul>
			</div>
			

			<div class="col-md-3" style="text-align: left;">
				<h3>KONTAK</h3>
				
				<p style="margin: 5px"><i class="far fa-envelope"></i><?=' '. $pengaturan->email ?></p>
				<p style="margin: 5px"><i class="fa fa-phone"></i><?= ' '.$pengaturan->no_hp ?></p>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: black;color: white;padding: 10px">
	<div class="container">
	<div class="row">
		<div class="col-md-5">
			<p>Copyright © <?php echo date("Y")?> MariDonasi.com. All rights reserved</p>
		</div>
		<div class="col-md-5">
			<p><?=' '. $pengaturan->alamat ?></p>
		</div>
		<div class="col-md-2">
			<ul class="nav-atas" style="float: right;">
	          <li style="margin: 0px 5px"><i class="fab fa-facebook-square"></i></li>
	          <li style="margin: 0px 5px"><i class="fab fa-instagram"></i></li>
	          <li style="margin: 0px 5px"><i class="fab fa-youtube"></i></li>
	        </ul>
		</div>
	</div>
</div>
</div>

@endforeach
