@extends('layout.app')
@section('title', 'Daftar')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/custom/style-register-login.css') }}">
		<!-- error -->
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
<div class="container" style="padding: 20px">
    <form action="{{ route('register') }}" method="post" id="form1">
        {{ csrf_field() }}
		<div class="wrapper register-login">
			<strong class="line-thru"><h2 class="center f2">DAFTAR DENGAN EMAILMU</h2></strong>
			<input type="text" name="nama" id="nama" class="form-controler is-invalid" placeholder="Nama Lengkap" value="{{ old('nama') }}" required autofocus>
				<div class="invalid-feedback" id="invalid-nama" style="display: none">
	         	 	Nama lengkap tidak boleh kosong.
	        	</div>
			<input type="email" name="email" id="email" class="form-controler is-invalid" placeholder="Email" value="{{ old('email') }}" required>
			<div class="invalid-feedback" id="invalid-email" style="display: none">
	         	 	Email lengkap tidak boleh kosong.
	        	</div>
			<input type="password" name="password" class="form-controler is-invalid" placeholder="Password">
			<div class="form-check" style="margin-bottom: 10px">
		    	<input type="checkbox" class="form-check-input" id="exampleCheck1">
			    	<label class="form-check-label" for="exampleCheck1">Setuju 
			    		<a href="#">
			    			Syarat & Ketentuan
			    		</a>
			    	</label>
		  </div>
			<button class="btn btn-daftar" type="submit">DAFTAR</button>
	</form>
			<strong class="line-thru"><h2 class="center f2">ATAU</h2></strong>
			<a href="#" class="btn btn-fb">
				<img src="{{ asset('assets/img/icon/facebook.svg') }}" alt="logo" id="logo_head" style="width:12px;">
				Daftar Dengan Facebook
			</a>
			<a href="#" class="btn btn-google">
				<img src="{{ asset('assets/img/icon/google.svg') }}" alt="logo" id="logo_head" style="width:12px;">
				Daftar Dengan Google
			</a>
		</div>
</div>


<script type="text/javascript">
function errorMessageDisplay(){
  if($("#nama").val() ==''){
    $("#nama").css("margin-bottom", "0px");
    $("#invalid-nama").css("display", "unset");
    $("#invalid-nama").css("margin-bottom", "15px");
    $("#nama").css("border-color", "red");
    $("#nama").css("border-style", "solid");
  }else{
  	$("#nama").css("margin-bottom", "15px");
    $("#invalid-nama").css("display", "none");
    $("#invalid-nama").css("margin-bottom", "0px");
    $("#nama").css("border-color", "unset");
    $("#nama").css("border-style", "inset")
  }

  if($("#email").val() ==''){
  	$("#email").css("margin-bottom", "0px");
    $("#invalid-email").css("display", "unset");
    $("#invalid-email").css("margin-bottom", "15px");
    $("#email").css("border-color", "red");
    $("#email").css("border-style", "solid");
  }else{
  	$("#email").css("margin-bottom", "15px");
    $("#invalid-email").css("display", "none");
    $("#invalid-email").css("margin-bottom", "0px");
    $("#email").css("border-color", "unset");
    $("#email").css("border-style", "inset")
  }

}

$("#nama").blur(function(){
  errorMessageDisplay();
}).keyup(function(){
  errorMessageDisplay();
  });


$("#email").blur(function(){
  errorMessageDisplay();
}).keyup(function(){
  errorMessageDisplay();
  });

</script>

<!-- <script type="text/javascript">


	$().ready(function() {
  $("#form1").validate();
});


</script> -->


@endsection


