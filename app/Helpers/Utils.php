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
    /**
     * Gera o ticket da solicitação
     * @param Servico $servico
     * @return string $ticket
     */
    public static function gerarTicket(Servico $servico): string
    {
        return $servico->ticket_id . Carbon::now()->format('YmdHs');
    }

    /**
     * Envia os emails para o usuário e para o especialista
     * @param Contato $contato
     */
    public static function enviarEmailsUsuarioEspecialista(Contato $contato)
    {
        self::enviarEmailContatoEspecialista($contato);
        self::enviarEmailContatoUsuario($contato);
    }

    /**
     * Envia email para o especialista
     * @param Contato $contato
     */
    public static function enviarEmailContatoEspecialista(Contato $contato)
    {
        Mail::to($contato->servico->email)
            ->send(new ContatoEspecialista($contato));
    }

    /**
     * Envia email para o usuário
     * @param Contato $contato
     */
    public static function enviarEmailContatoUsuario(Contato $contato)
    {
        Mail::to($contato->email)
            ->send(new ContatoUsuario($contato));
    }
}
