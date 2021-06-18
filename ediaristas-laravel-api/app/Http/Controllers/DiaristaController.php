<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaristaRequest;
use App\Models\Diarista;
use App\Services\ViaCep;

class DiaristaController extends Controller
{	

	public function __construct(protected ViaCep $viaCep){}
	// public $viaCep;
	// public function __construct(ViaCep $viaCep){
	// 	$this->viaCep = $viaCep;
	// }

  public function index()
	{
		$diaristas = Diarista::get();
		return view('index', [
			'diaristas'=> $diaristas,
		]);
	}
  
	public function create()
	{
		return view('create');
	}

	public function store(DiaristaRequest $request)
	{
		$dados = $request->except('_token');
		$dados['foto_usuario'] = $request->foto_usuario->store('public');

		$dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
		$dados['cep'] = str_replace(['-'], '', $dados['cep']);
		$dados['telefone'] = str_replace(['(', ')', '-', ' '], '', $dados['telefone']);
		$dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

		Diarista::create($dados);

		return redirect()->route('diaristas.index');
	}

	public function edit(int $id)
	{
		$diarista = Diarista::findOrFail($id);
		return view('edit', [
			'diarista' => $diarista
		]);
	}
	
	public function update(int $id, DiaristaRequest $request)
	{
		$diarista = Diarista::findOrFail($id);
		
		$dados = $request->except(['_token', '_method']);
		if($request->hasFile('foto_usuario'))
			$dados['foto_usuario'] = $request->foto_usuario->store('public');

		$dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
		$dados['cep'] = str_replace(['-'], '', $dados['cep']);
		$dados['telefone'] = str_replace(['(', ')', '-', ' '], '', $dados['telefone']);
		$dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

		$diarista->update($dados);
		return redirect()->route('diaristas.index');		
	}
	
	public function destroy(int $id)
	{
		$diarista = Diarista::findOrFail($id);
		$diarista->delete();

		return redirect()->route('diaristas.index');
	}
}
