<?php

namespace Tests\Feature;

use App\Models\Contato;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BuscasContatoTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Reseta o banco de dados após cada teste

    protected $dados;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dados = [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => "(88) 1111-1111",
            'celular' => "(88) 1111-1111",
            'empresa' => $this->faker->company,
            'mensagem' => $this->faker->text(200),
            'servico_id' => 1,
            'ticket' => 'ABC1190820242257',
            'estado' => $this->faker->country,
            'cidade' => $this->faker->city
        ];

        DB::table('servicos')->insert([
            ['servico' => 'Servico 1', 'especialista' => 'especialista 1', 'email' => 'email.1@teste.com', 'ticket_id' => 'ABC1']
        ]);

        DB::table('contatos')->insert([$this->dados]);
    }

    /**
     * Testa pegar todos os itens que estão no banco
     */
    public function test_pegar_todos_os_itens_salvos_no_banco(): void
    {

        $response = $this->get('/api/contato');

        $response->assertJsonFragment(['sucesso' => true]);

        $response->assertJsonStructure([
            'sucesso',
            'dados' => [
                '*' => [
                    'id',
                    'nome',
                    'empresa',
                    'telefone',
                    'celular',
                    'cidade',
                    'estado',
                    'ticket',
                    'mensagem',
                    'servico_id',
                    'created_at',
                    'servico_id',
                    'updated_at',
                    'servico' => [
                        "id",
                        "servico",
                        "especialista",
                        "email",
                        "ticket_id",
                        "created_at",
                        "updated_at"
                    ],
                ]
            ],
            'mensagem'
        ]);
    }

    /**
     * Testa pegar um item pelo ticket
     */
    public function test_pegar_um_item_pelo_ticket(): void
    {
        $response = $this->get('/api/contato/ABC1190820242257');

        $response->assertJsonStructure([
            'sucesso',
            'dados' => [
                'id',
                'nome',
                'empresa',
                'telefone',
                'celular',
                'cidade',
                'estado',
                'ticket',
                'mensagem',
                'servico_id',
                'created_at',
                'servico_id',
                'updated_at',
                'servico' => [
                    "id",
                    "servico",
                    "especialista",
                    "email",
                    "ticket_id",
                    "created_at",
                    "updated_at"
                ],
            ],
            'mensagem'
        ]);
    }
}
