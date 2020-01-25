@extends('layout.app')
@section('title', 'Galang Dana')

@section('content')

<style type="text/css">
	.topup_li{
		width: 31%;
		background: blue; 
		margin: 5;
		padding: 10px;
		text-align: center
	}

	.topup_radio{
		position: absolute;
		visibility: hidden;
	}
</style>

<style type="text/css">
	.text {
   width: 100%;
   text-align: center;
   margin-top: 20px;
   height: 70px;
}

.area {
   width: 100%;
   float: left;
   margin-top: 15px;
}

.area .input,
.area .input label {
   width: 100%;
   float: left;
   position: relative;
}

.area .input {
   overflow: hidden;
   border-radius: 2px;
   color: #fff;
  background-color: #b13d3d;
  border-radius: 10px;
   box-shadow:0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
   transition: 300ms;
   -webkit-transition: 300ms;
   -ms-transition: 300ms;
}

.area .input input {
   display: none;
}

.area .input label {
   font-weight: 400;
   color: #fff;
   text-align: center;
   text-transform:uppercase;
   cursor: pointer;
   font-size: 14px;
   z-index: 3;
   transition: 300ms;
   -webkit-transition: 300ms;
   -ms-transition: 300ms;
   height: 45px;
   line-height: 45px;
}

.area .input:hover{
   box-shadow:0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15)
}
.area .input label:hover {
   letter-spacing: .8px;
   
}

.click-efect {
   position: absolute;
   top: 0;
   left: 0;
   background: rgba(0, 0, 0, 0.2);
   border-radius: 50%;
}


</style>

<div class="container" >
	<div class="row justify-content-center" style="margin: 15px 0px" >
		<div class="col-md-6">

			<form onsubmit="return submitForm();">
			  <label class="sr-only" for="inlineFormInputGroup">Nominal</label>
		      <div class="input-group mb-2">
		        <div class="input-group-prepend">
		          <div class="input-group-text" >Rp.</div>
		        </div>
		        <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="0" style="height: 50px" onkeyup="convertToRupiah(this)">
		      </div>

<!-- 		      <ul style="display: flex;flex-flow: row-cust wrap;list-style: none;">
		      	<li class="topup_li"><input type="radio" style="width: 100%" class="topup_radio" id="topup_radiobutton_nominal-50000" name="selector">50.000</li>
		      	<li class="topup_li"><input  type="radio"  class="topup_radio" id="topup_radiobutton_nominal-50000" name="selector">100.000</li>
		      	<li class="topup_li"><input type="radio" class="topup_radio" id="topup_radiobutton_nominal-50000" name="selector">150.000</li>
		      	<li class="topup_li"><input type="radio" class="topup_radio" id="topup_radiobutton_nominal-50000" name="selector">200.000</li>
		      	<li class="topup_li"><input type="radio" class="topup_radio" id="topup_radiobutton_nominal-50000" name="selector">500.000</li>
		      	<li class="topup_li"><input type="radio" class="topup_radio" id="topup_radiobutton_nominal-50000" name="selector">1.000.000</li>
		      </ul>
		       -->
		      <div class="area">
		         <div class="row">
		            <div class="col-md-4 ">
		               <span class="input ">
	                        <label for="radio-1">50.000</label>
	                        <input type="radio" name="radio" id="radio-1">
	                    </span>
		            </div>
		            <div class="col-md-4">
		               <span class="input">
                            <label for="radio-2">100.000</label>
                            <input type="radio" name="radio" id="radio-2">
                        </span>
		            </div>
		            <div class="col-md-4">
		               <span class="input">
	                        <label for="radio-3">150.000</label>
	                        <input type="radio" name="radio" id="radio-3">
	                    </span>
		            </div>
		            <div class="col-md-4" style="margin: 10px 0px">
		               <span class="input">
                            <label for="radio-4">200.000</label>
                            <input type="radio" name="radio" id="radio-4">
                        </span>
		            </div>
		            <div class="col-md-4" style="margin: 10px 0px">
		               <span class="input">
                            <label for="radio-4">500.000</label>
                            <input type="radio" name="radio" id="radio-4">
                        </span>
		            </div>
		            <div class="col-md-4" style="margin: 10px 0px">
		               <span class="input">
                            <label for="radio-4">1.000.000</label>
                            <input type="radio" name="radio" id="radio-4">
                        </span>
		            </div>
		         </div>
		      </div>
		    
		      <button id="submit" class="tombol-n1" style="margin: 0 auto;display: table;font-size: 20px;width: 100%;text-align: center;">ISI SALDO</button>
		</form>
		</div>




	</div>

</div>

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
</script>

<script type="text/javascript">
	$(".area .input").click(function(e) {

   $("label[type='checkbox']", this)
   var pX = e.pageX,
      pY = e.pageY,
      oX = parseInt($(this).offset().left),
      oY = parseInt($(this).offset().top);

   $(this).addClass('active');

   if ($(this).hasClass('active')) {
      $(this).removeClass('active')
      if ($(this).hasClass('active-2')) {
         if ($("input", this).attr("type") == "checkbox") {
            if ($("span", this).hasClass('click-efect')) {
               $(".click-efect").css({
                  "margin-left": (pX - oX) + "px",
                  "margin-top": (pY - oY) + "px"
               })
               $(".click-efect", this).animate({
                  "width": "0",
                  "height": "0",
                  "top": "0",
                  "left": "0"
               }, 400, function() {
                  $(this).remove();
               });
            } else {
               $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
               $('.x-' + oX + '.y-' + oY + '').animate({
                  "width": "300px",
                  "height": "300px",
                  "top": "-150px",
                  "left": "-150px",
               }, 600);
            }
         }

         if ($("input", this).attr("type") == "radio") {

            $(".area .input input[type='radio']").parent().removeClass('active-radio').addClass('no-active-radio');
            $(this).addClass('active-radio').removeClass('no-active-radio');

            $(".area .input.no-active-radio").each(function() {
               $(".click-efect", this).animate({
                  "width": "0",
                  "height": "0",
                  "top": "0",
                  "left": "0"
               }, 400, function() {
                  $(this).remove();
               });
            });

            if (!$("span", this).hasClass('click-efect')) {
               $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
               $('.x-' + oX + '.y-' + oY + '').animate({
                  "width": "500px",
                  "height": "500px",
                  "top": "-250px",
                  "left": "-250px",
               }, 600);
            }

         }
      }
      if ($(this).hasClass('active-2')) {
         $(this).removeClass('active-2')
      } else {
         $(this).addClass('active-2');
      }
   }

});
</script>


<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
    function submitForm() {
        // Kirim request ajax
        $.post("{{ route('topup.store') }}",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            jumlah: $('input#jumlah').val(),
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