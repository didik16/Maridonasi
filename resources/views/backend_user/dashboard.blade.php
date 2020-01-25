@extends('layout.backend_user')
@section('title', 'Galang Dana')

@section('judul', 'Dashboard')
@section('dashboard_nav', 'active-nav')
@section('content')

<div class="row">
	@foreach($detail_donasi_user as $detail)
	<div class="col-lg-4 col-xs-6" style="padding: 5px"> 
		<div class="small-box bg-yellow">
			<div class="inner">
	 			<h3 style="color: white">{{$detail->jumlah_donasi}}</h3>
				<p style="color: white">Total Donasi</p>
			</div>
			<div class="icon">
				<i class="fas fa-hand-holding-heart" aria-hidden="true"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-xs-6" style="padding: 5px">
		<div class="small-box bg-aqua">
			<div class="inner">
	 			<h3 style="color: white">{{ 'Rp.' .number_format($detail->jumlah_dana)}}</h3>
				<p style="color: white">Total Didonasikan</p>
			</div>
			<div class="icon">
				<i class="fas fa-money-bill-wave"></i>
			</div>
		</div>
	</div>
		<div class="col-lg-4 col-xs-6" style="padding: 5px">
		<div class="small-box bg-red1">
			<div class="inner">
	 			<h3 style="color: white">{{$detail->jumlah_galang}}</h3>
				<p style="color: white">Total Galang Dana</p>
			</div>
			<div class="icon">
				<i class="fas fa-child" aria-hidden="true"></i>
			</div>
		</div>
	</div>
	@endforeach
</div>
<div class="panel">
	<div id="chartDashboard" style="width:100%; height:400px;"></div>
</div>

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
        var myChart = Highcharts.chart('chartDashboard', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Data Donasi Bulan Ini'
            },
            xAxis: {
                categories: {!!json_encode($tanggal)!!},
            },
            yAxis: {
                title: {
                    text: 'Data Donasi'
                }
            },
            series: [{
                name: 'Total Donasi',
                data: {!!json_encode($dana)!!}
            }]
        });
    });
</script>
@endsection

@endsection