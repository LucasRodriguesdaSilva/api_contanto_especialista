<?php

namespace Tests\Feature;

use App\Mail\ContatoEspecialista;
use App\Mail\ContatoUsuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CreateContatoRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $dados;


    protected function setUp(): void 
    {
        parent::setUp();

        Mail::fake();


        $this->dados = [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => "(88) 1111-1111",
            'celular' => "(88) 1111-1111",
            'empresa' => $this->faker->company,
            'mensagem' => $this->faker->text(200),
            'servico_id' => 1,
            'estado' => $this->faker->country,
            'cidade' => $this->faker->city
        ];

        DB::table('servicos')->insert([
            ['servico' => 'Servico 1', 'especialista' => 'especialista 1', 'email' => 'email.1@teste.com', 'ticket_id' => 'ABC1']
        ]);
    }

    /** 
     * Testa se em caso de dados faltantes a resposta retorna 422 Unprocessable Entity 
     * e os campos 'success' e 'message' estão corretos quando há erros de validação.
     */
    public function test_retorna_erro_quando_nao_existe_dados_na_requisicao(): void
    {
        $response = $this->post('/api/contato', ['nome' => 'teste 1']);

        $response->assertStatus(422)
            ->assertJsonFragment(['sucesso' => false, 'mensagem' => "Validation errors"]);
    }

    /**
     * Testa se caso alguma informação não esta de acordo com o seu tipo a resposta
     * retorna 422 com success false
     */

    public function test_retorna_erro_quando_os_dados_nao_estao_corretos(): void
    {
        $response = $this->postJson('/api/contato', [
            "nome" => "lucas",
            "email" => "testeteste1com",
            "servico_id" => '',
            "empresa" => "teste",
            "celular" => "8811111111",
            "cidade" => 1,
            "estado" => 10
        ]);

        $response->assertStatus(422)
            ->assertJsonFragment(['sucesso' => false, 'mensagem' => "Validation errors"]);
    }

    /**
     * Teste para geral de criação dos dados de contato
     */

    public function test_gerar_contato_fale_com_especialista(): void
    {
        $response = $this->postJson('/api/contato', $this->dados);

        $response->assertStatus(201)
            ->assertJsonFragment(['sucesso' => true]);
    }

    /**
     * Teste para verificar se o email foi enviado com sucesso 
     * para o usuário
     */
    public function test_email_foi_enviado_com_sucesso_para_usuario(): void
    {
        $response = $this->postJson('/api/contato', $this->dados);

        Mail::assertSent(ContatoUsuario::class, function ($mail) {
            return $mail->hasTo($this->dados['email']);
        });

    }

    /**
     * Teste para verificar se o email foi enviado para o especialista
     */
    public function test_email_foi_enviado_com_sucesso_para_especialista(): void
    {
        $response = $this->postJson('/api/contato', $this->dados);

        Mail::assertSent(ContatoEspecialista::class, function ($mail) {
            return $mail->hasTo('email.1@teste.com');
        });

    }

    /**
     * Teste para verificar se os dados foram salvos com sucesso
     */
    public function test_dados_foram_salvos_com_sucesso_no_banco_dados(): void
    {
        $response = $this->postJson('/api/contato', $this->dados);

        $this->assertDatabaseHas('contatos', [
            'nome' => $this->dados['nome'],
            'email' => $this->dados['email'],
            'telefone' => $this->dados['telefone'],
            'celular' => $this->dados['celular'],
            'empresa' => $this->dados['empresa'],
            'mensagem' => $this->dados['mensagem'],
            'servico_id' => $this->dados['servico_id'],
            'estado' => $this->dados['estado'],
            'cidade' => $this->dados['cidade']
        ]);

    }


}
