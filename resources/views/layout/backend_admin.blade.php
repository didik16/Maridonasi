<!DOCTYPE html>
<html>
<head>
	<title>MariDonasi.com - @yield('title')</title>
	<meta name="viewport" content="width=device-width, initian-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/custom/style-footer.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/custom/style-header.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/backend_user/backend.css') }}">
	
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/icon/favicon.png') }}"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="https://kit.fontawesome.com/142f9408d2.js" crossorigin="anonymous"></script>
	@yield('script')
</head>
<body>

<style type="text/css">

	body{
		background: #F6FBFF;
	}
	.vertikal{
		color: white;
		padding: 20px 20px;
		border-bottom: 1px solid #171b1d;
	}

	.vertikal:hover{
		color: white;
		background: #111415;
	}

	.active-nav{
		color: white;
		background: #111415;
	}

	p{
		padding: 0;
		margin: 0;
	}

	a:hover{
		color: white;
		text-decoration: none;
	}

	.white{
		color: white;
	}

	.menu{
		color: black;
	}
	.menu:hover{
		background: #e3e0e0;
		color: black;
	}
</style>

<!-- Navbar -->
@include('includes/header')

<div class="container">
	<div class="row" style="margin: 35px 0px;box-shadow: 1px 1px 10px 1px #c6bfbf;border-radius: 20px">
		<div class="col-md-3" style="background: #1a2124;padding: 0;border-radius: 20px 0px 0px 20px;padding-bottom: 20px">
			<div class="row" style="margin: 0px;margin-bottom: 15px; background: #ac3939;padding: 25px 0px;border-radius: 20px 0px 0px 0px">
				<div class="col-md-3">
					<img src="https://images.jg-cdn.com/image/8e00f08f-7572-4f7d-a623-6e3741b0659c.jpg?template=size75x75face" style="border-radius: 50%;width: 100%">
				</div>
				<div class="col-md-9" style="padding : 0">
					<h4 style="font-weight: bolder;color: white">Admin</h4>
				</div>
			</div>

			<nav class="nav flex-column">
			  <a class="nav-link vertikal @yield('dashboard_nav')" href="/dashboard_admin"><i class="fas fa-home"></i> Dashboard</a>
			  <a class="nav-link vertikal @yield('galang_dana_nav')" href="/dashboard_admin/verifikasi_galang_dana"><i class="fas fa-flag"></i> Galang Dana</a>
			  <a class="nav-link vertikal @yield('donasi_nav')" href="/dashboard_admin/donasi"><i class="fas fa-users"></i> Donasi</a>
			  <a class="nav-link vertikal @yield('transaksi_nav')" href="/dashboard_admin/transaksi_saldo"><i class="fas fa-history"></i> Transaksi Saldo</a>
			  <a class="nav-link vertikal @yield('pencairan_nav')" href="#"><i class="fas fa-money-bill-wave-alt"></i> Pencairan Dana</a>
			  <a class="nav-link vertikal" href="{{ route('logout') }}"
    				onclick="event.preventDefault();
            		document.getElementById('logout-form').submit();" 
            		style="margin-top: 80px">
            		<i class="fas fa-sign-out-alt"></i> Keluar</a>
			</nav>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			    {{ csrf_field() }}
			</form>
		</div>
		<div class="col-md-9" style="background: white;padding: 20px;border-radius: 0px 20px 20px 0px;">

				<h1 style="margin: 10px 0px;">@yield('judul')</h1>

				@yield('content')

		</div>
	</div>
</div>

<!-- footer -->
@include('includes/footer')

</body>
</html>