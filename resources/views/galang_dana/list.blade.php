@extends('layout.app')
@section('title', 'Galang Dana')

@section('content')

<div class="card mt-3">

	<div class="card-header">
		<h1 ><i class="fas fa-hand-holding-heart" style="margin-top: 10px"></i> List Penggalangan Dana</h1>
		<a class="btn btn-primary" href="/galangdana/buat" role="button">Buat Galang Dana</a>
			<h1>{{ 'woi'.$parameters = \Request::segment(1) }}</h1>
	</div>
<div class="card-body">
<div class="table-responsive">
 <table class="table table-stripped">
 	<thead class="table-dark">
 		<tr>
 			<td>No</td>
 			<td>Tanggal</td>
 			<td>Dana</td>
 			<td>Terkumpul</td>
 			<td>Durasi</td>
 			<td>Alamat</td>
 			<td>Keterangan</td>
 			<td>Action</td>
 		</tr>
 	</thead>
 	<tbody>
 		<?php $no=1;?>
 		@foreach($galang_dana as $galang)
 		
		<tr>
			
			<td><?php echo $no?></td>
			<!-- <td>{{ $galang->tgl_galang_dana }}</td> -->
			<td>{{ $galang->jumlah_dana }}</td>
			<td>{{ $galang->terkumpul }}</td>
			<td>{{ $galang->durasi }}</td>
	
			<td>{{ $galang->deskripsi }}</td>
			<td>

				<a style="font-size: 12px" href="/galang_dana/edit/{{ $galang->id_galang_dana }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true"><i class="fas fa-edit"></i> Edit</a>
				|
				<a style="font-size: 12px" href="/galang_dana/hapus/{{ $galang->id_galang_dana }}" class="btn btn-danger btn-lg active" role="button" aria-pressed="true"><i class="fas fa-trash-alt"></i> Hapus</a>
				
			</td>
		</tr>
		<?php $no++;?>
		@endforeach
		
 	</tbody>
 </table>
</div>
</div>
</div>

@endsection