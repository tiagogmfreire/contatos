<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Classe de migration para criar a tabela de domínio de UFs.
 */
class CreateUf extends Migration
{
    /**
     * Executa a migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uf', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uf',2); //char(2)
            $table->string('descricao', 30); //varchar(30)
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
        Schema::dropIfExists('uf');
    }
}
