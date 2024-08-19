<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponseHelper
{
    public static function rollback($erro, $mensagem = 'Houve um erro no processamento', $code = 400)
    {
        DB::rollBack();
        self::throw($erro,[],$mensagem,$code);
    }

    public static function throw(string $erro,  $dados = [], $mensagem = "Houve um erro no processamento", $code = 400)
    {
        Log::info('ERRO API: ' . $erro);

        throw new HttpResponseException(response()->json([
            'sucesso' => false,
            'mensagem' => $mensagem,
            'dados' => $dados
        ],$code));
    }

    public static function sendResponse($data, $mensagem, $code = 200)
    {
        return response()->json([
            'sucesso' => true,
            'dados' => $data,
            'mensagem' => !empty($mensagem) ? $mensagem : '' 
        ], $code);

    }
}
