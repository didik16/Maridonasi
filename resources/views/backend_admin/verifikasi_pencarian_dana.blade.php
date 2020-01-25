@extends('layout.backend_admin')
@section('title', 'Pencairan Dana')

@section('judul', 'Pencairan Dana')
@section('pencairan_nav', 'active-nav')
@section('script')


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sp-1.0.1/datatables.min.css"/>

@endsection
@section('content')
<div class="row">
	<div class="col-md-12" >
    <hr>
    <a href="#" class="btn btn-primary">Verifikasi Pencairan</a>
    <hr>
		<table class="table table-bordered" id="saldo">
       <thead>
          <tr>
             <th>Id</th>
             <th>Id Galang</th>
             <th>Tgl</th>
             <th>User</th>
             <th>Jumlah</th>
             <th>Keterangan</th>
             <th>Bukti</th>
             <th>Status</th>
          </tr>
       </thead>
      <tbody>
        @foreach($pencairan_dana as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->id_galang_dana }}</td>
          <td>{{ $p->created_at }}</td>
          <td>{{ $p->id_user }}</td>
          <td>{{ 'Rp. '.number_format($p->jumlah) }}</td>
          <td>{{ $p->keterangan }}</td>
          <td>{{ $p->bukti }}</td>
          <td>{{ $p->status }}</td>
        </tr>
        @endforeach
      </tbody>
       <tfoot>
          <tr>
             <th>Id</th>
             <th>Id Galang</th>
             <th>Tgl</th>
             <th>User</th>
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
    
    $('#saldo').DataTable({
    });
  });
</script>

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sp-1.0.1/datatables.min.js"></script>

	</div>
</div>

@endsection