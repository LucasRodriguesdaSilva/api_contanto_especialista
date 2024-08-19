<?php

namespace App\Helpers;

use App\Models\Servico;
use Carbon\Carbon;

class Utils
{
    public static function gerarTicket(Servico $servico): string
    {
        return $servico->ticket_id . Carbon::now()->format('YmdHs');  
    }
}
