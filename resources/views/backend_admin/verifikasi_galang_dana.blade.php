@extends('layout.backend_admin')
@section('title', 'Galang Dana')

@section('judul', 'Verifikasi Galang Dana')
@section('galang_dana_nav', 'active-nav')
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
    <a href="/dashboard_admin/galang_dana" class="btn btn-primary">Semua Galang Dana</a>
    <hr>
		<table class="table table-bordered" id="verifikasi">
       <thead>
          <tr>
             <th>Id</th>
             <th>Judul</th>
             <th>Jumlah Dana</th>
             <th>Status</th>
             <th>Verifikasi</th>
          </tr>
       </thead>
      <tbody>
        @foreach($galang_dana as $p)
        <tr>
          <td>{{ $p->id_galang_dana }}</td>
          <td>{{ $p->judul }}</td>
          <td>{{ 'Rp. '.number_format($p->jumlah_dana) }}</td>
          <td><center><p style="background: yellow;font-weight: bold;">{{ $p->status }}</p></center></td>
          <td>
            <center><a href='#' class='btn btn-default btn-small'><i class="fas fa-edit"></i></a></center>
          </td>
        </tr>
        @endforeach
      </tbody>
       <tfoot>
          <tr>
             <th>Id</th>
             <th>Judul</th>
             <th>Jumlah Dana</th>
             <th>Status</th>
             <th>Verifikasi</th>
          </tr>
       </tfoot>
    </table>
  </div>

<!-- Modal -->

   <!-- <script>
   $(document).ready( function () {
    var table = $('#verifikasi').DataTable({
           processing: true,
           serverSide: true,
           ajax: "/dashboard_admin/data_verifikasi_galang_dana",
           columns: [
                    { data: 'id_galang_dana', name: 'id_galang_dana' },
                    { data: 'judul', name: 'judul' },
                    { data: 'jumlah_dana', name: 'jumlah_dana' },
                    { data: 'status', name: 'status', render: $.fn.dataTable.render.number( ',', '.', 2, '$' ) },
                    { defaultContent: '<a href=""><button>Detail</button></a>' },
                 ]
        });
          $('#verifikasi tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert( data[1] +"'s salary is: "+ data[2] );
    } );

     });
  </script> -->


  <script>
  $(function () {
    
    $('#verifikasi').DataTable({
/*      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,*/
    });
  });
</script>

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sp-1.0.1/datatables.min.js"></script>

	</div>
</div>

@endsection