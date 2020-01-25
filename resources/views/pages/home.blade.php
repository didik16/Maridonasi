@extends('layout/app')

@section('title', 'Homepgae')


@section('content')

<h1>Halaman home</h1>

<p>Hallo, {{ Auth::user()->name }}. Apakabars?</p>



<?php if(!empty($mahasiswa)) { ?>

<ul>
	@foreach ($mahasiswa as $mhs)
	<li> {{ $mhs }} </li>
	@endforeach
</ul>

<?php } ?>

@endsection