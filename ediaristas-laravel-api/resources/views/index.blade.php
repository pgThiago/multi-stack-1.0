@extends('app')

@section('titulo', 'Página Inicial')
@section('conteudo')
	<h1>Lista de diaristas</h1>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Nome</th>
				<th scope="col">Telefone</th>
				<th scope="col">Ações</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($diaristas as $diarista)
				<tr>
					<th scope="row">{{ $diarista->id }}</th>
					<td>{{ $diarista->nome_completo }}</td>
					<td>{{ \Clemdesign\PhpMask\Mask::apply($diarista->telefone, '(00) 00000-0000') }}</td>
					<td>
						<a class="btn btn-primary" href="{{ route('diaristas.edit', $diarista) }}">Editar</a>
						<a class="btn btn-danger" href="{{ route('diaristas.destroy', $diarista) }}" onClick="return confirm('Tem certeza que deseja apagar?')">Remover</a>
					</td>					
				</tr>
			@empty
			<tr>
				<th></th>
				<td>Nenhum registro cadastrado</td>						
			</tr>
			@endforelse
		</tbody>
	</table>
	<a href="{{ route('diaristas.create') }}" class="btn btn-success">Nova Diarista</a>
@endsection
