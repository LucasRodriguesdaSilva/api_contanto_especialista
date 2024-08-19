<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Helpers\Utils;
use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContatoController extends Controller
{
    //
    function criar(ContatoRequest $request) {
        $dados = $request->validated();
        
        $servico = Servico::find($dados['servico_id']);
        $dados['ticket'] = Utils::gerarTicket($servico);

        DB::beginTransaction();
        try {
            $contato = Contato::cadastrar($dados);
            DB::commit();
            
            Utils::enviarEmailsUsuarioEspecialista($contato);

            return ApiResponseHelper::sendResponse(
                ['ticket' => $contato->ticket],
                'Obrigado pelo Contato. As informações da Solicitação foram enviadas para o E-mail informado!',
                201
            );
        } catch (\Throwable $th) {
            return ApiResponseHelper::rollback($th, $th->getMessage());
        }
    }
}
