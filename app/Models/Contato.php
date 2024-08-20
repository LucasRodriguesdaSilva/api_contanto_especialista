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

    static public function buscarTodos()
    {
        return self::with('servico')->get();
    }

    static public function getByTicket($ticket): Contato
    {
        return self::with('servico')
            ->where('ticket', $ticket)
            ->first();
    }

    /**
     * Cadastra os dados importantes e retorna o objeto contato
     * 
     * @param array $data
     * @return Contato
     */
    static public function cadastrar(array $data): Contato
    {
        return Contato::create($data);
    }

    public function servico()
    {
        return $this->hasOne(Servico::class, 'id', 'servico_id');
    }
}
