@extends('layout.backend_admin')
@section('title', 'Transaksi Saldo')

@section('judul', 'Transaksi Saldo')
@section('backend_admin', 'active-nav')
@section('script')


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sp-1.0.1/datatables.min.css"/>

@endsection
@section('content')
<div class="row">
	<div class="col-md-12" >
		<table class="table table-bordered" id="saldo">
       <thead>
          <tr>
             <th>Id</th>
             <th>User</th>
             <th>Tanggal Transaksi</th>
             <th>Jumlah</th>
          </tr>
       </thead>
      <tbody>
        @foreach($saldo as $p)
        <tr>
          <td>{{ $p->id_saldo }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ $p->created_at }}</td>
          <td>{{ 'Rp. '.number_format($p->jumlah) }}</td>
        </tr>
        @endforeach
      </tbody>
       <tfoot>
          <tr>
             <th>Id</th>
             <th>User</th>
             <th>Tanggal Transaksi</th>
             <th>Jumlah</th>
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