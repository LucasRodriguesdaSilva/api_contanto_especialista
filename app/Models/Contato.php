<?php

namespace App\Models;

use App\Interfaces\ContatoInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model implements ContatoInterface
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'empresa',
        'email',
        'telefone',
        'celular',
        'estado',
        'cidade',
        'ticket',
        'servico_id',
        'mensagem'
    ];

    /**
     * Cadastra os dados importantes e retorna o objeto contato
     * 
     * @param array $data
     * @return App\Models\Contato
     */
    static public function cadastrar(array $data): Contato
    {
        return Contato::create($data);
    }
}
