@extends('layout.backend_user')
@section('title', 'Galang Dana')

@section('judul', 'Galang Dana')
@section('galang_dana_nav', 'active-nav')
@section('content')
<!-- <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>  -->


<div class="row justify-content-center">

 <div class="col-md-9" >
   <ul class="nav nav-tabs nav-justified" role="tablist">
     <li class="nav-item">
       <a class="nav-link menu active" href="#galangdana" role="tab" data-toggle="tab">Galang Dana Saya</a>
     </li>
     <li class="nav-item">
       <a class="nav-link menu" href="#buat" role="tab" data-toggle="tab">Buat Galang Dana</a>
     </li>
     <!-- <li class="nav-item ">
       <a class="nav-link menu" href="#perkembangan" role="tab" data-toggle="tab">Perkembangan</a>
     </li>  -->
   </ul>

   <!-- Tab panes -->
   <div class="tab-content">
     <div role="tabpanel" class="tab-pane  active" id="galangdana" style="margin: 15px 0px">
     @if($galang_dana->count() > 0)
     <form action="/dashboard/cari_galang_dana" method="get">
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="cari" placeholder="Cari Galang Dana" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
      </div>
     </form>


     @foreach($galang_dana as $galang)
     <div class="row" style="margin-bottom: 10px">
      <div class="col-md-3">
       <div class="box-img" style="background-repeat: no-repeat;background-position: center center;background-size: cover;padding-bottom: 56%;min-width: 100%;background-image: url( {{ asset('assets/img/galang_dana/'.$galang->gambar )}} );">
       </div>
      </div>
      <div class="col-md-9" style="padding: 0">
       <h5>{{ $galang->judul}}</h5>
       <p style="font-size: 12px;display: unset">{{ $galang->tgl_galang_dana}} | Rp. {{ number_format($galang->jumlah_dana) }} </p>
       @if($galang->status == "YES") 
       <p style="background: green;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">DITERIMA</p>
       @elseif($galang->status == "CEK") 
       <p style="background: orange;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">DIPROSES</p>
       @else
       <p style="background: red;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">DITOLAK</p>
       @endif
       <div style="float: right;">
         <a href="/dashboard/edit_galang_dana/{{ $galang->id_galang_dana }}/{{ $galang->slug }}"><i class="fas fa-edit"></i></a>
         @if($galang->status == "YES") 
         <a href="/dashboard/perkembangan/{{ $galang->id_galang_dana }}"> | Perkembangan</a>
         @endif
        </div>
      </div>
     </div>
     @endforeach

     {{ $galang_dana->links() }}

     @else
      <center>
       <p style="width: 100%;background: #fff6ed;text-align: center;padding: 5px;margin-bottom: 10px">Anda belum melakukan galang_dana</p>
       <a href="/akun" class="tombol-n1 text-center">Mari galang_dana</a>
      </center>
     @endif
   </div>

   <div role="tabpanel" class="tab-pane " id="buat">
    <img src="{{ asset('assets/img/charity.jpg') }}" alt="charity" id="charity" style="width:100%;margin-bottom: 25px;margin-top: 15px">          

       <form action="/dashboard/store_galang_dana" method="post"  id="buatgalangdana" enctype="multipart/form-data">
           {{ csrf_field() }}
           <div class="form-group">
             <label class="form-label-fill" for="inputAddress" style="font-weight: bold;">Judul</label>
             <input type="text" class="form-control" name="judul" placeholder="Bantu Warga Pulih dari bencana" value="{{ old('judul') }}">
               
                 @if ($errors->has("judul"))
                 <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                   {{ ($errors->has("judul"))? $errors->first("judul"):""}}
                   </div>
                  @endif
                
           </div>
           <div class="form-row">
             <div class="form-group col-md-8">
               <label class="form-label-fill" for="inputEmail4" style="font-weight: bold;">Kebutuhan Dana</label>
               <input type="input" class="form-control" name="dana" placeholder="Minimal 1 Juta, Maksimal 500 Juta" value="{{ old('dana') }}" onkeyup="convertToRupiah(this)">
                @if ($errors->has("dana"))
                   <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                     {{ ($errors->has("dana"))? $errors->first("dana"):""}}
                    </div>
                @endif
             </div>
             <div class="form-group col-md-4">
               <label class="form-label-fill" for="inputPassword4" style="font-weight: bold;">Batas Hari</label>
               <select name="hari" class="form-control">
                 <option selected value="30">30 Hari</option>
                 <option value="60">60 Hari</option>
                 <option value="90">90 Hari</option>
               </select>
                
             </div>
           </div>
           <div class="form-group">
             <label class="form-label-fill" for="inputAddress2" style="font-weight: bold;">Alamat</label>
             <input type="text" class="form-control" name="alamat" placeholder="Isikan Alamat Rumah Pasien" value="{{ old('alamat') }}">
               @if ($errors->has("alamat"))
                   <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                     {{ ($errors->has("alamat"))? $errors->first("alamat"):""}}
                    </div>
                @endif
           </div>
           <div class="form-group">
               <label class="form-label-fill" for="inputAddress2" style="font-weight: bold;">Alamat URL</label>
                 <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text" style="font-weight: bold;">maridonasi.com/</div>
                    </div>
                      <input type="text" class="form-control" placeholder="bantuwayan" name="slug" style="height: 50px"value="{{ old('slug') }}">
                  </div>
              @if ($errors->has("slug"))
                   <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                     {{ ($errors->has("slug"))? $errors->first("slug"):""}}
                    </div>
                @endif
          </div>
           <div class="form-group">
              <label class="form-label-fill" style="font-weight: bold;">Gambar utama</label>
                <input type="file" name="foto" id="foto" class="dropify">
                   <small>note: ukuran gambar 750x480 pixel. (recommended) </small>
                @if ($errors->has("foto"))
                   <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                     {{ ($errors->has("foto"))? $errors->first("foto"):""}}
                    </div>
                @endif
           </div>
           <div class="form-group">
             <label class="form-label-fill" for="exampleTextarea" style="font-weight: bold;">Keterangan</label>
             <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ old('keterangan') }}</textarea>

           </div>          
           <div class="form-group">
             <div class="form-check">
               <input class="form-check-input" type="checkbox" name="cek" value="y">
               <label class="form-check-label form-label-fill" for="gridCheck">
                 Setuju <a href="#">Syarat & Ketentuan</a>
               </label>
             </div>
             @if ($errors->has("cek"))
                   <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                     {{ ($errors->has("cek"))? $errors->first("cek"):""}}
                    </div>
                @endif
           </div>
           
            <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message"></span>
          </div>

           <button type="submit" class="btn btn-primary" name="send_form" style="width: 100%">Buat Penggalangan Dana</button>
         </form>
   </div>
<!--    <div role="tabpanel" class="tab-pane " id="perkembangan">

   </div> -->
  </div> <!-- tutup tab content -->




  
 </div>

 <div class="col-md-3" > <!-- panel kanan -->
  <div style="background: #ff9e3b17;padding: 10px">
   @foreach($detail_galang_dana_user as $detail)
   <p>Total Galang Dana</p>
   <p style="font-weight: bolder;">{{ $detail->jumlah_galang_dana}}</p>
   <hr>
   <p>Total Dana</p>
   <p style="font-weight: bolder;">Rp. {{ number_format($detail->jumlah_dana)}}</p>
   @endforeach 
  </div> 
 </div>
</div>


<script type="text/javascript" src="{{ asset('assets/js/dropify/dist/js/dropify.min.js' )}}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/dropify/dist/css/dropify.min.css')}}">
        <script type="text/javascript">
            $(document).ready(function(){
                $('.dropify').dropify({
                    messages: {
                        default: 'Drag atau drop untuk memilih gambar',
                        replace: 'Ganti',
                        remove:  'Hapus',
                        error:   'error'
                    }
                });
            });
             
        </script>

        <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
       CKEDITOR.replace( 'keterangan', {
          filebrowserUploadUrl: "{{route('upload_ckeditor', ['_token' => csrf_token() ])}}",
          filebrowserUploadMethod: 'form'
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
</script>



<!-- <script>
   if ($("#buatgalangdana").length > 0) {
    $("#buatgalangdana").validate({
      
    rules: {
      nama: {
        required: true,
        maxlength: 2
      },
  

    },
    messages: {
        
      nama: {
        required: "Please enter name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      
         
    },
    submitHandler: function(form) {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#send_form').html('Sending..');
      $.ajax({
        url: 'http://localhost:8000/dashboard/store_galang_dana' ,
        type: "POST",
        data: $('#buatgalangdana').serialize(),
        success: function( response ) {
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
 
            document.getElementById("buatgalangdana").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },1000);
        }
      });
    }
  })
}
</script> -->


<!--  <script type="text/javascript">
    $(document).ready(function() {
        $(".send_form").click(function(e){
            e.preventDefault();


            var _token = $("input[name='_token']").val();
            var nama = $("input[name='nama']").val();
            var judul = $("input[name='judul']").val();
            var dana = $("input[name='dana']").val();
            var hari = $("textarea[name='hari']").val();
            var alamat = $("input[name='alamat']").val();
            var slug = $("textarea[name='slug']").val();
            var foto = $("input[name='foto']").val();
            var keterangan = $("textarea[name='keterangan']").val();
            var cek = $("textarea[name='cek']").val();


            $.ajax({
                url: "/dashboard/store_galang_dana",
                type:'POST',
                data: {_token:_token, nama:nama},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });


        }); 


        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });
</script>  -->


<!--   <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
 <script>
ClassicEditor
    .create( document.querySelector( '#keterangan' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );
</script> -->

@endsection