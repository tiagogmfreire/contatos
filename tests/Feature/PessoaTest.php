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

    /**
     * Teste de CPF vazio
     *
     * @return void
     */
    public function testCriarCPFVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->nome = 'teste';
        $pessoa->cpf = '';

        $this->expectException(CustomException::class);

        $pessoa->criar(0);
    }

    /**
     * Teste de CPF maior que 11 chars
     *
     * @return void
     */
    public function testCriarCPFMenor()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->nome = 'teste';
        $pessoa->cpf = '1111111111';

        $this->expectException(CustomException::class);

        $pessoa->criar(0);
    }

    /**
     * Teste de CPF menor que 11 chars
     *
     * @return void
     */
    public function testCriarCPFMaior()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->nome = 'teste';
        $pessoa->cpf = '1111111111111111111';

        $this->expectException(CustomException::class);

        $pessoa->criar(0);
    }

    /**
     * Teste de e-mail vazio
     *
     * @return void
     */
    public function testCriarEmailVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->nome = 'teste';
        $pessoa->cpf = '01458102165';

        $this->expectException(CustomException::class);

        $pessoa->criar(0);
    }

    /**
     * Teste de nome vazio
     *
     * @return void
     */
    public function testAtualizarNomeVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->id = 1;
        $pessoa->nome = '';

        $this->expectException(CustomException::class);

        $pessoa->atualizar();
    }

    /**
     * Teste de nome vazio
     *
     * @return void
     */
    public function testAtualizarCPFVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->id = 1;
        $pessoa->nome = 'teste';
        $pessoa->cpf = '';

        $this->expectException(CustomException::class);

        $pessoa->atualizar();
    }

    /**
     * Teste de nome vazio
     *
     * @return void
     */
    public function testAtualizarCPFMenor()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->id = 1;
        $pessoa->nome = 'teste';
        $pessoa->cpf = '1111111111';

        $this->expectException(CustomException::class);

        $pessoa->atualizar();
    }

    /**
     * Teste de nome vazio
     *
     * @return void
     */
    public function testAtualizarCPFMaior()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->id = 1;
        $pessoa->nome = 'teste';
        $pessoa->cpf = '111111111111111111111';

        $this->expectException(CustomException::class);

        $pessoa->atualizar();
    }

    /**
     * Teste de e-mail vazio
     *
     * @return void
     */
    public function testAtualizarEmailVazio()
    {
        $pessoaModel = new PessoaModel();
        $pessoa = new Pessoa($pessoaModel);

        $pessoa->nome = 'teste';
        $pessoa->cpf = '01458102165';

        $this->expectException(CustomException::class);

        $pessoa->atualizar(1);
    }
}
