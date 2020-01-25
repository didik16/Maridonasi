@extends('layout.backend_user')
@section('title', 'Semua Pencairan Dana')

@section('judul', 'Semua Pencairan Dana')
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
    <a href="/dashboard/pencairan" class="btn btn-primary">Request Pencairan Dana</a>
    <hr>
		<table class="table table-bordered" id="verifikasi">
       <thead>
        @php $no=1 @endphp
          <tr>
             <th>No</th>
             <th>Judul</th>
             <th>Tanggal</th>
             <th>Jumlah</th>
             <th>Keterangan</th>
             <th>Bukti</th>
             <th>Status</th>
          </tr>
       </thead>
      <tbody>
        @foreach($galang_dana as $p)
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $p->judul }}</td>
          <td>{{ $p->created_at }}</td>
          <td>{{ 'Rp. '.number_format($p->jumlah_dana) }}</td>
          <td>{{ $p->keterangan }}</td>
          <td>{{ $p->bukti }}</td>
          <td>{{ $p->status }}</td>
        </tr>
        @endforeach
      </tbody>
       <tfoot>
          <tr>
             <th>No</th>
             <th>Judul</th>
             <th>Tanggal</th>
             <th>Jumlah</th>
             <th>Keterangan</th>
             <th>Bukti</th>
             <th>Status</th>
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