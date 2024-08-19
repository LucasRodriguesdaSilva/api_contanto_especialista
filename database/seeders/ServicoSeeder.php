<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('servicos')->insert([
            ['servico' => 'Servico 1', 'especialista' => 'especialista 1', 'email' => 'email.1@teste.com', 'ticket_id' => 'ABC1'],
            ['servico' => 'Servico 2', 'especialista' => 'especialista 1', 'email' => 'email.2@teste.com', 'ticket_id' => 'ABC2'],
            ['servico' => 'Outros', 'especialista' => 'especialista 1', 'email' => 'email.3@teste.com', 'ticket_id' => 'ABC3'],
        ]);
    }
}
