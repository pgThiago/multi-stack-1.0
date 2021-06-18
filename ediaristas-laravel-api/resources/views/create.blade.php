@extends('app')

@section('titulo', 'Cadastro | Diarista')
@section('conteudo')
	<h1>Cadastro</h1>
	<form action="{{ route('diaristas.store') }}" method="POST" enctype="multipart/form-data">

		@include('_form')			

	</form>
@endsection
