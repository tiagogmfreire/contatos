<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Classe de migration para criar a tabela de Endereço.
 */
class CreateEndereco extends Migration
{
    /**
     * Executa a migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoa'); //chave estrangeira
            $table->integer('uf_id');
            $table->foreign('uf_id')->references('id')->on('uf'); //chave estrangeira
            $table->text('logradouro');
            $table->text('complemento')->nullable();
            $table->text('bairro');
            $table->text('cidade');
            $table->char('cep', 8);
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
        Schema::dropIfExists('endereco');
    }
}
