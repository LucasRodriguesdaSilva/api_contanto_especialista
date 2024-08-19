<?php

namespace App\Helpers;

use App\Mail\ContatoEspecialista;
use App\Mail\ContatoUsuario;
use App\Models\Contato;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class Utils
{
    public static function gerarTicket(Servico $servico): string
    {
        return $servico->ticket_id . Carbon::now()->format('YmdHs');
    }

    public static function enviarEmailsUsuarioEspecialista(Contato $contato)
    {
        self::enviarEmailContatoEspecialista($contato);
        self::enviarEmailContatoUsuario($contato);
    }

    public static function enviarEmailContatoEspecialista(Contato $contato)
    {
        Mail::to($contato->servico->email)
            ->send(new ContatoEspecialista($contato));
    }

    public static function enviarEmailContatoUsuario(Contato $contato)
    {
        Mail::to($contato->email)
            ->send(new ContatoUsuario($contato));
    }
}
