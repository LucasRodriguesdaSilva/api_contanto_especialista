<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponseHelper
{
    /**
     * Rollback para dados salvos no banco
     * @param $erro
     * String do erro ocorrido
     * @param $mensagem
     * Mensagem personalizada que sera retornada no response
     * @param $code
     */
    public static function rollback($erro, $mensagem = 'Houve um erro no processamento', $code = 400)
    {
        DB::rollBack();
        self::throw($erro,[],$mensagem,$code);
    }

    /**
     * Exceção customizada
     * @param $erro
     * @param $dados
     * @param $mensagem
     * @param $code
     */
    public static function throw(string $erro,  $dados = [], $mensagem = "Houve um erro no processamento", $code = 400)
    {
        Log::info('ERRO API: ' . $erro);

        throw new HttpResponseException(response()->json([
            'sucesso' => false,
            'mensagem' => $mensagem,
            'dados' => $dados
        ],$code));
    }

    /**
     * Response customizado
     * @param $data
     * @param $mensagem
     * @param $code
     */
    public static function sendResponse($data, $mensagem, $code = 200)
    {
        return response()->json([
            'sucesso' => true,
            'dados' => $data,
            'mensagem' => !empty($mensagem) ? $mensagem : '' 
        ], $code);

    }
}
