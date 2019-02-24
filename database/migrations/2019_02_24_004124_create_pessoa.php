<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Classe de migration para criar a tabela de Pessoa 
 */
class CreatePessoa extends Migration
{
    /**
     * Executa a migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nome');
            $table->char('cpf', 11)->unique(); //CPF char(11) com restrição de unicidade
            $table->string('email', 150)->unique(); //varchar(150) unique
            $table->string('telefone', 20)->nullable();//varchar(20) aceita null
            $table->timestamps();
            $table->softDeletes(); //permite exclusão lógica
        });
    }

    /**
     * Rollback da migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa');
    }
}
