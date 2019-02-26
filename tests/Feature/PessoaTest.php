<?php

namespace Tests\Feature;

use App\Exceptions\CustomException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entidades\Pessoa;
use App\Model\PessoaModel;

class PessoaTest extends TestCase
{
    /**
     * Teste de detalhar pessoa com argumento vazio
     *
     * @return void
     */
    public function testDetalharVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $this->expectException(CustomException::class);

        $pessoa->detalhar(0);
    }

    /**
     * Teste de atualizar pessoa com argumento vazio
     *
     * @return void
     */
    public function testAtualizarVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->id = 0;

        $this->expectException(CustomException::class);

        $pessoa->atualizar();
    }

    /**
     * Teste de exlucir pessoa com argumento vazio
     *
     * @return void
     */
    public function testExcluirVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->id = 0;

        $this->expectException(CustomException::class);

        $pessoa->excluir(0);
    }

    /**
     * Teste de nome vazio
     *
     * @return void
     */
    public function testCriarNomeVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->nome = '';

        $this->expectException(CustomException::class);

        $pessoa->criar(0);
    }
}
