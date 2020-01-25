<!DOCTYPE html>
<html>
<head>
	<title>MariDonasi.com - @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('assets/css/custom/style-footer.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('assets/css/custom/style-header.css') }}">
	
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/icon/favicon.png') }}"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="{{ secure_asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ secure_asset('assets/js/popper.min.js') }}"></script>
	<script src="https://kit.fontawesome.com/142f9408d2.js" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

	@yield('script')

<?php $parameters = \Request::segment(1);
  if($parameters=="campaign"){
   ?>
      <link rel="stylesheet" href="{{ secure_asset('assets/css/custom/style-home.css') }}">
  <?php } ?>


</head>
<body>


<style type="text/css">
	p{
		margin:0;
	}
</style>

<div class="preloader">
  <div class="loading">
    <img src="{{ secure_asset('assets/img/icon/loading.gif') }}" width="100%">
  </div>
</div>

	<!-- Navbar -->
	@include('includes/header')

	
		@yield('content')


	<!-- footer -->
	@include('includes/footer')
	

@if(Session::has('message'))
<script type="text/javascript">
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    </script>
  @endif

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58b2484078d62074c0942108/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script>
$(document).ready(function(){
$(".preloader").fadeOut();
})
</script>






</body>
</html>
