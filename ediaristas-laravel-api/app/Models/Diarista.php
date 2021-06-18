<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
	use HasFactory;
	protected $fillable = ['nome_completo', 'cpf', 'email', 'telefone', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep', 'codigo_ibge', 'foto_usuario'];

	protected $visible = ['nome_completo', 'cidade', 'foto_usuario', 'reputacao'];

	protected $appends = ['reputacao'];

	public function getFotoUsuarioAttribute(string $valor)
	{
		return config('app.url') . '/' . $valor;		
	}
	
	public function getReputacaoAttribute($valor)
	{
		return mt_rand(1, 5);		
	}

	static public function buscaPorCodigoDoIBGE(int $codigoIBGE)
	{
		return self::where('codigo_ibge', $codigoIBGE)->limit(6)->get();
	}

	static public function quantidadePorCodigoDoIBGE(int $codigoIBGE)
	{
		$quantidade = self::where('codigo_ibge', $codigoIBGE)->count();
		return $quantidade > 6 ? $quantidade - 6 : 0;
	}
}
