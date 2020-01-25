@extends('layout.backend_admin')
@section('title', 'Galang Dana')

@section('judul', 'Galang Dana')
@section('galang_dana_nav', 'active-nav')

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
@endsection

@section('content')

<div class="row">

<div class="col-md-12" >
  <form action="/dashboard_admin/cari_galang_dana" method="get">
    <div class="row">
      <div class="form-group col-md-5">
        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
      </div>
      <div class="form-group col-md-7">
        <div class="input-group">
          <input type="text" class=" form-control" name="cari" placeholder="Cari Galang Dana" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
          </div>
        </div>
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
      </div>
     </div>
     @endforeach

     {{ $galang_dana->links() }}

   </div>

 
   </div>

<script type="text/javascript">

    $('#datetimepicker4').datetimepicker({

        

    }); 

</script> 

@endsection