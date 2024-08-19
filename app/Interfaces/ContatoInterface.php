<?php

namespace App\Interfaces;

use App\Models\Contato;
use App\Models\Servico;

interface ContatoInterface
{
    static public function cadastrar(array $data): Contato;
}
