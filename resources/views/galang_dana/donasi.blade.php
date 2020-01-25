@extends('layout.app')
@section('title', 'Galang Dana')

@section('content')

<style type="text/css">
	/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.hidden {
    display: none;
}
</style>

<div class="container" >
	<div class="row justify-content-center" style="margin: 15px 0px" >
		<div class="col-md-6">

		@foreach($detail as $detail)
		
			<img src="{{ asset('assets/img/galang_dana/4.jpg') }}" width="100%" style="margin-bottom: 10px">
			<h3 style="padding: 0;margin-bottom: 25px">{{ $detail->judul }}</h3>
			<input type="hidden" id="judul" value="{{ $detail->judul }}">
			<input type="hidden" id="id_galang_dana" value="{{ $detail->id_galang_dana }}">



		@endforeach

			<form onsubmit="return submitForm();">


			  <label class="sr-only" for="inlineFormInputGroup">Nominal</label>
		      <div class="input-group mb-2">
		        <div class="input-group-prepend">
		          <div class="input-group-text" >Rp.</div>
		        </div>
		        <input type="text" name="jumlah_dana" id="jumlah_dana" class="form-control" placeholder="0" style="height: 50px" onkeyup="convertToRupiah(this)">
		      </div>

		      <div class="row" style="margin: 15px 0px">
		      	<div class="col-md-10" style="padding: 0">
		      		<p>Sembunyikan nama saya (donasi anonim)</p>
		      	</div>
		      	<div class="col-md-2">
		      		<label class="switch">
					  <input type="checkbox" id="anonim" name="anonim" value="Y">
					  <span class="slider round"></span>
					</label>
		      	</div>
		      </div>
		      <div class="row" style="margin: 15px 0px">
		      	<div class="col-md-10"  style="padding: 0">
		      		<p>Tulis Komentar</p>
		      	</div>
		      	<div class="col-md-2">
		      		<label class="switch">
					  <input type="checkbox" id="komentarc">
					  <span class="slider round"></span>
					</label>
		      	</div>

		      	<textarea class="form-control hidden" id="komentar" rows="3" style="width: 100%;"></textarea>
		      </div>
			
		      <button id="submit" class="tombol-n1" style="margin: 0 auto;display: table;font-size: 20px;width: 100%;text-align: center;">BERIKUTNYA</button>
		      <p style="font-size: 12px;margin-top: 10px">Dengan mengklik berikutnya, anda seuju dengan Terms & Condition Maridonasi.com</p>
		</form>
			
		</div>




	</div>

	@foreach($donasi as $donasi)

	<p>{{ $donasi->id_donasi }}</p>
	@endforeach

</div>




<script type="text/javascript">
	 $('#komentarc').on('change', function() {
         if($('#komentarc').prop("checked")) {
                $('#komentar').removeClass('hidden');
        } else {
            $('#komentar').addClass('hidden');
        }
    }); 
</script>


<script type="text/javascript">
		
function convertToRupiah(objek) {
	  separator = ".";
	  a = objek.value;
	  b = a.replace(/[^\d]/g,"");
	  c = "";
	  panjang = b.length; 
	  j = 0; 
	  for (i = panjang; i > 0; i--) {
	    j = j + 1;
	    if (((j % 3) == 1) && (j != 1)) {
	      c = b.substr(i-1,1) + separator + c;
	    } else {
	      c = b.substr(i-1,1) + c;
	    }
	  }
	  objek.value = c;

	}       

	function convertToAngka()
	{	var nominal= document.getElementById("nominal").value;
		var angka = parseInt(nominal.replace(/,.*|[^0-9]/g, ''), 10);
		document.getElementById("angka").innerHTML= angka;
	}       

	function convertToAngka()
	{	var nominal1= document.getElementById("nominal1").value;
		var angka1 = parseInt(nominal.replace(/,.*|[^0-9]/g, ''), 10);
		document.getElementById("angka1").innerHTML= angka;
	}

	</script>



    <script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
    function submitForm() {
        // Kirim request ajax
        $.post("{{ route('donation.store') }}",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            jumlah_dana: $('input#jumlah_dana').val(),
            judul: $('input#judul').val(),
            id_galang_dana: $('input#id_galang_dana').val(),
            anonim: $('checkbox#anonim').val(),
            komentar: $('textarea#komentar').val(),


        },


        function (data, status) {
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function (result) {
                    location.reload();
                },
                // Optional
                onPending: function (result) {
                    location.reload();
                },
                // Optional
                onError: function (result) {
                    location.reload();
                }
            });
        });


        return false;
    }


    </script>


@endsection