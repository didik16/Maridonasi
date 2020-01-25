@extends('layout.app')
@section('title', 'Masuk')
@section('content')
<div class="container" style="padding: 20px">
	<link rel="stylesheet" href="{{ asset('assets/css/custom/style-register-login.css') }}">
	    <form action="{{ route('login') }}" method="post">
	        {{ csrf_field() }}
			<div class="wrapper register-login">
				<strong class="line-thru"><h2 class="center f2">MASUK DENGAN AKUNMU</h2></strong>
				<input type="email" name="email" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<div class="form-check" style="margin-bottom: 10px">
			    	<input type="checkbox" class="form-check-input" id="exampleCheck1">
				    	<label class="form-check-label" for="exampleCheck1" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 15px">
				    		Ingatkan Saya
				    	</label>
			  	</div>
				<button class="btn btn-daftar" type="submit" style=" font-weight: bold;">MASUK</button>
				<a href="#" class="hover-text center " style="margin-bottom: 10px">
					Lupa Kata Sandi anda ?
				</a>
				<strong class="line-thru"><h2 class="center f2">ATAU</h2></strong>
				<div class="row">
					<div class="col-md-6">
						<a href="{{ url('/auth/facebook') }}" class="btn btn-fb">
							<img src="{{ asset('assets/img/icon/facebook.svg') }}" alt="logo" id="logo_head" style="width:12px;">
							Masuk Dengan Facebook
						</a>
					</div>
					<div class="col-md-6">
						<a href="{{ url('/auth/google') }}" class="btn btn-google">
							<img src="{{ asset('assets/img/icon/google.svg') }}" alt="logo" id="logo_head" style="width:12px;">
							Masuk Dengan Google
						</a>
					</div>
				</div>
				<hr>
				<h2 class="center f2 " style="display: block!important;margin: 10px 0;color: black">Belum Punya Akun ?</h2>
				<a href="/register" class="btn btn-btn-daftar" style="background: linear-gradient(45deg,#eb6565 0%, #a33333 100%); font-weight: bold;">MENDAFTAR KE MARIDONASI</a>
			</div>
		</form>
</div>
@endsection
