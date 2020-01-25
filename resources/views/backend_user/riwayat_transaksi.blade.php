@extends('layout.backend_user')
@section('title', 'Dashboard - Transaksi Saya')

@section('riwayat_nav', 'active-nav')
@section('judul', 'Riwayat Transaksi')

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
@endsection


@section('content')
<div class="row justify-content-center">

	<div class="col-md-8" >
		@if($saldo->count() > 0) <!-- jika ada data ini ditampilkan, jika data kosong tidak tampil -->
		<form action="/dashboard/cari_riwayat" method="get"> <!-- yg action ada di controller, pakai method get -->
			<div class="input-group mb-3">
			  <input type="text" class="form-control" name="cari" placeholder="Cari Riwayat Transaksi" aria-describedby="basic-addon2"> <!-- input text dengan nama cari -->
			  <div class="input-group-append">
			    <button class="btn btn-outline-secondary" type="submit">Cari</button>
			  </div>
			</div>
		</form>


		@foreach($saldo as $data_saldo)
		
				<h3>Isi Saldo Rp. {{ number_format($data_saldo->jumlah)}}</h3>
				<p style="font-size: 12px;display: unset">{{ $data_saldo->created_at}}</p>
				@if($data_saldo->status == "sukses") 
				<p style="background: green;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">SUKSES</p>
				@elseif($data_saldo->status == "pending") 
				<p style="background: #ffc800;padding: 5px;display: unset;border-radius: 5px;color: black;font-size: 10px">PENDING</p>
				 <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $data_saldo->snap_token }}')">Selesaikan Transaksi</button>
				@else 
				<p style="background: red;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">GAGAL</p>
				@endif
				<hr>

		@endforeach

		{{ $saldo->links() }}

		@else
			<center>
				<p style="width: 100%;background: #fff6ed;text-align: center;padding: 5px;margin-bottom: 10px">Anda belum memiliki Riwayat Transaksi</p>
				<a href="/akun" class="tombol-n1 text-center">Mari Donasi</a>
			</center>
		@endif

	</div>

	<div class="col-md-4" >
		<div style="background: #ff9e3b17;padding: 10px">
			@foreach($detail_saldo as $detail)
			<p>Total Topup</p>
			<p style="font-weight: bolder;">{{ $detail->total_topup}}</p>
			<hr>
			<p>Total Dana Saldo</p>
			<p style="font-weight: bolder;">Rp. {{ number_format($detail->jumlah_dana)}}</p>
			@endforeach	
		</div>	
	</div>
</div>


<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
    function submitForm() {
        // Kirim request ajax
        $.post("{{ route('topup.store') }}",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            jumlah: $('input#jumlah').val(),
        },


        function (data, status) {
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function (result) {
                    location.reload();
                },
                // Optional
                onPending: function (result) {
                    location.reload();
                },
                // Optional
                onError: function (result) {
                    location.reload();
                }
            });
        });


        return false;
    }


    </script>

<script type="text/javascript">
    $(function () {
        $('#tanggal').datetimepicker({
          useCurrent: true,
        });
    });
</script>


@endsection