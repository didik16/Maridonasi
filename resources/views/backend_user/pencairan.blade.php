@extends('layout.backend_user')
@section('title', 'Pencairan Dana')

@section('judul', 'Pencairan Dana')
@section('pencairan_nav', 'active-nav')
@section('script')
<!-- 	<link  href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sp-1.0.1/datatables.min.css"/>

@endsection
@section('content')
<div class="row">
	<div class="col-md-12" >
    <hr>
    <a href="/dashboard/semua_pencairan" class="btn btn-primary">Semua Pencairan Dana</a>
    <hr>
		<table class="table table-bordered" id="verifikasi">
       <thead>
        @php $no=1 @endphp
          <tr>
             <th>No</th>
             <th>Judul</th>
             <th>Dana Terkumpul</th>
             <th>Telah Dicairkan</th>
             <th>Dapat Dicairkan</th>
             <th>Pencarian</th>
          </tr>
       </thead>
      <tbody>
        @foreach($galang_dana as $p)
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $p->judul }}</td>
          <td>{{ 'Rp. '.number_format($p->terkumpul) }}</td>
          <td>{{ 'Rp. '.number_format($p->telah_dicairkan) }}</td>
          <td>{{ 'Rp. '.number_format($p->dapat_dicairkan) }}</td>
          <td>
            <center><a href='#' class='btn btn-default btn-small'><i class="fas fa-edit"></i></a></center>
          </td>
        </tr>
        @endforeach
      </tbody>
       <tfoot>
          <tr>
             <th>No</th>
             <th>Judul</th>
             <th>Dana Terkumpul</th>
             <th>Telah Dicairkan</th>
             <th>Dapat Dicairkan</th>
             <th>Pencarian</th>
          </tr>
       </tfoot>
    </table>
  </div>

  <script>
  $(function () {
    
    $('#verifikasi').DataTable({

    });
  });
</script>

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sp-1.0.1/datatables.min.js"></script>

	</div>
</div>

@endsection