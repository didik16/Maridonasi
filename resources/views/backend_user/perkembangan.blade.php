@extends('layout.backend_user')
@section('title', 'Perkembangan Galang Dana')

@section('judul', 'Perkembangan Galang Dana')
@section('galang_dana_nav', 'active-nav')
@section('script')
<!-- 	<link  href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sp-1.0.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('content')
<div class="row">
	<div class="col-md-8" >
    <hr>
    <a href="/dashboard/galang_dana" class="btn btn-primary">Galang Dana</a>
    <hr>
		
    @foreach($perkembangan as $p)
    <form action="/dashboard/tambah_perkembangan" method="post" >
       {{ csrf_field() }}
       <input type="hidden" name="id" value="{{ $p->id_galang_dana }}">
       <div class="form-group">
         <label class="form-label-fill" for="inputAddress" style="font-weight: bold;">Judul</label>
         <input type="text" class="form-control" name="judul" placeholder="Bantu Warga Pulih dari bencana" value="{{ $p->judul }}" disabled>
           
             @if ($errors->has("judul"))
             <div class="alert alert-danger" role="alert" style="margin-top: 10px;padding: 5px;" >
               {{ ($errors->has("judul"))? $errors->first("judul"):""}}
               </div>
              @endif
            
       </div>
       <div class="form-group">
        <label class="form-label-fill" for="inputAddress" style="font-weight: bold;">Tanggal</label>
        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" name="tanggal"/>
            <div class="input-group-append" data-target="#datetimepicker4"  data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
      </div>
      <div class="form-group">
         <label class="form-label-fill" for="exampleTextarea" style="font-weight: bold;">Keterangan</label>
         <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="send_form" style="width: 100%">Tambah Perkembangan</button>  
    </form>
    @endforeach

  </div>

<script type="text/javascript">

    $('#datetimepicker4').datetimepicker({
       
      format: 'YYYY-MM-DD'
    }); 

</script>

 <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
       CKEDITOR.replace( 'keterangan', {
          filebrowserUploadUrl: "{{route('upload_ckeditor', ['_token' => csrf_token() ])}}",
          filebrowserUploadMethod: 'form'
      });
  </script> 


	</div>
</div>

@endsection