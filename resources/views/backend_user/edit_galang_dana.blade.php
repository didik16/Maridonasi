@extends('layout.backend_user')
@section('title', 'Edit Galang Dana')

@section('judul', 'Edit Galang Dana')
@section('galang_dana_nav', 'active-nav')
@section('content')
@foreach($galang_dana as $p)
<form action="/dashboard/update_galang_dana" method="post"  id="buatgalangdana" enctype="multipart/form-data">
           {{ csrf_field() }}
           <input type="hidden" name="id" value="{{ $p->id_galang_dana }}">
           <div class="form-group">
             <label class="form-label-fill" for="inputAddress" style="font-weight: bold;">Judul</label>
             <input type="text" class="form-control" name="judul" placeholder="Bantu Warga Pulih dari bencana" value="{{ $p->judul }}">
               
                 @if ($errors->has("judul"))
                 <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                   {{ ($errors->has("judul"))? $errors->first("judul"):""}}
                   </div>
                  @endif
                
           </div>
           <div class="form-row">
             <div class="form-group col-md-8">
               <label class="form-label-fill" for="inputEmail4" style="font-weight: bold;">Kebutuhan Dana</label>
               <input type="input" class="form-control" name="dana" placeholder="Minimal 1 Juta, Maksimal 500 Juta" value="{{ $p->jumlah_dana }}" onkeyup="convertToRupiah(this)" @if($p->status=="YES") readonly="readonly" @endif >
                @if ($errors->has("dana"))
                   <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                     {{ ($errors->has("dana"))? $errors->first("dana"):""}}
                    </div>
                @endif
             </div>
             <div class="form-group col-md-4">
               <label class="form-label-fill" for="inputPassword4" style="font-weight: bold;">Batas Hari</label>
               <select name="hari" class="form-control" @if($p->status=="YES") readonly="readonly" @endif>
                 <option value="30" @if($p->durasi ==30)selected @endif>30 Hari</option>
                 <option value="60" @if($p->durasi ==60)selected @endif>60 Hari</option>
                 <option value="90" @if($p->durasi ==90)selected @endif>90 Hari</option>
               </select>
                
             </div>
           </div>
           <div class="form-group">
             <label class="form-label-fill" for="inputAddress2" style="font-weight: bold;">Alamat</label>
             <input type="text" class="form-control" name="alamat" placeholder="Isikan Alamat Rumah Pasien" value="{{ $p->alamat }}">
               @if ($errors->has("alamat"))
                   <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
                     {{ ($errors->has("alamat"))? $errors->first("alamat"):""}}
                    </div>
                @endif
           </div>
          <img src="{{ asset('assets/img/galang_dana/'.$p->gambar) }}" style="width:100%;">
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
             <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ $p->deskripsi }}</textarea>
           </div>          
            <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message"></span>
          </div>

           <button type="submit" class="btn btn-primary" name="send_form" style="width: 100%">Edit Galang Dana</button>
         </form>

         @endforeach


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
@endsection