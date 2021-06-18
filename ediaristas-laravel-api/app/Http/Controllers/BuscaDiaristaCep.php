<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use App\Services\ViaCep;
use Illuminate\Http\Request;

class BuscaDiaristaCep extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(Request $request, ViaCep $viaCep)
	{
		$endereco = $viaCep->buscar($request->cep);
		
		if(!$endereco)
			return response()->json(['erro'=>'Cep inválido'], 400);
		
		return [
			'diaristas' => Diarista::buscaPorCodigoDoIBGE($endereco['ibge']),
			'quantidade_diaristas' => Diarista::quantidadePorCodigoDoIBGE($endereco['ibge'])
		];		
	}
}
