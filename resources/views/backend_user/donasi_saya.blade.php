@extends('layout.backend_user')
@section('title', 'Galang Dana')

@section('judul', 'Donasi Saya')
@section('donasi_saya_nav', 'active-nav')
@section('content')

<div class="row justify-content-center">

	<div class="col-md-8" >
		@if($donasi_saya->count() > 0) <!-- jika ada data ini ditampilkan, jika data kosong tidak tampil -->
		<form action="/dashboard/cari_donasi" method="get"> <!-- yg action ada di controller, pakai method get -->
			<div class="input-group mb-3">
			  <input type="text" class="form-control" name="cari" placeholder="Cari Donasi" aria-describedby="basic-addon2"> <!-- input text dengan nama cari -->
			  <div class="input-group-append">
			    <button class="btn btn-outline-secondary" type="submit">Cari</button>
			  </div>
			</div>
		</form>


		@foreach($donasi_saya as $donasi) <!-- foreach data pencarian -->
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-3">
				<div class="box-img" style="background-repeat: no-repeat;background-position: center center;background-size: cover;padding-bottom: 56%;min-width: 100%;background-image: url( {{ asset('assets/img/galang_dana/'.$donasi->gambar )}} );">
				</div>
			</div>
			<div class="col-md-9" style="padding: 0">
				<h5>{{ $donasi->judul}}</h5>
				<p style="font-size: 12px;display: unset">{{ $donasi->tgl_donasi}} | Rp. {{ number_format($donasi->jumlah_dana) }} </p>
				@if($donasi->status_dana == "sukses") 
				<p style="background: green;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">SUKSES</p>
				@elseif($donasi->status_dana == "pending") 
				<p style="background: #ffc800;padding: 5px;display: unset;border-radius: 5px;color: black;font-size: 10px">PENDING</p>
				 <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $donasi->snap_token }}')">Complete Payment</button>
				@else 
				<p style="background: red;padding: 5px;display: unset;border-radius: 5px;color: white;font-size: 10px">GAGAL</p>
				@endif

			</div>
		</div>
		@endforeach

		{{ $donasi_saya->links() }} <!-- ini untuk fungsi pagination -->

		@else <!-- jika belum ada data di database -->
			<center>
				<p style="width: 100%;background: #fff6ed;text-align: center;padding: 5px;margin-bottom: 10px">Anda belum melakukan Donasi</p>
				<a href="/akun" class="tombol-n1 text-center">Mari Donasi</a>
			</center>
		@endif

	</div>

	<div class="col-md-4" >
		<div style="background: #ff9e3b17;padding: 10px">
			@foreach($detail_donasi_user as $detail) <!-- foreach data detail ( abaikan ) -->
			<p>Total Donasi</p>
			<p style="font-weight: bolder;">{{ $detail->jumlah_donasi}}</p>
			<hr>
			<p>Total Dana Donasi</p>
			<p style="font-weight: bolder;">Rp. {{ number_format($detail->jumlah_dana)}}</p>
			@endforeach	
		</div>	
	</div>
</div>

<!-- fungsi midtrans -->
<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
    function submitForm() {
        // Kirim request ajax
        $.post("{{ route('donation.store') }}",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            jumlah_dana: $('input#jumlah_dana').val(),
            judul: $('input#judul').val(),
            id_galang_dana: $('input#id_galang_dana').val(),
            anonim: $('checkbox#anonim').val(),
            komentar: $('textarea#komentar').val(),


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


@endsection