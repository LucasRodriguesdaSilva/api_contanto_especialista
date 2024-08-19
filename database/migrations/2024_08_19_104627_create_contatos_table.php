<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string("servico");
            $table->string('especialista');
            $table->string('email')->unique();
            $table->string('ticket_id', 4);
            $table->timestamps();
        });


        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('empresa');
            $table->string('email');
            $table->string('telefone')->nullable(true);
            $table->string('celular');
            $table->string('cidade');
            $table->string('estado');
            $table->string('ticket',50)->unique();
            $table->text("mensagem");
            $table->foreignId('servico_id')->references('id')->on('servicos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos');
        Schema::dropIfExists('contatos');
    }
};
