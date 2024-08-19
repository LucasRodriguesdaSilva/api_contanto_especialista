<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateContatoRequestTest extends TestCase
{

    /** 
     * Testa se em caso de dados faltantes a resposta retorna 422 Unprocessable Entity 
     * e os campos 'success' e 'message' estão corretos quando há erros de validação.
     */
    public function test_retorna_erro_quando_nao_existe_dados_na_requisicao(): void
    {
        $response = $this->post('/api/contato', ['nome' => 'teste 1']);

        $response->assertStatus(422)
            ->assertJsonFragment(['success' => false, 'message' => "Validation errors"]);
    }

    /**
     * Testa se caso alguma informação não esta de acordo com o seu tipo a resposta
     * retorna 422 com success false
     */

    public function test_retorna_erro_quando_os_dados_nao_estao_corretos(): void
    {
        $response = $this->post('/api/contato', [
            "nome" => "lucas",
            "email" => "testeteste1com",
            "servico_id" => '',
            "empresa" => "teste",
            "celular" => "8811111111",
            "cidade" => 1,
            "estado" => 10
        ]);

        $response->assertStatus(422)
            ->assertJsonFragment(['success' => false, 'message' => "Validation errors"]);
    }


}
