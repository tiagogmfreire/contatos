<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\EnderecoModel;
use App\Entidades\Endereco;

class EnderecoTest extends TestCase
{
    /**
     * Teste de detalhar endereço com argumento vazio
     *
     * @return void
     */
    public function testDetalharVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);

        $this->expectException(\Exception::class);

        $endereco->detalhar(0);
    }

    /**
     * Teste de atualizar endereço com argumento vazio
     *
     * @return void
     */
    public function testAtualizarVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);

        $endereco->id = 0;

        $this->expectException(\Exception::class);

        $endereco->atualizar();
    }

    /**
     * Teste de exlucir pessoa com argumento vazio
     *
     * @return void
     */
    public function testExcluirVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);

        $endereco->id = 0;

        $this->expectException(\Exception::class);

        $endereco->excluir(0);
    }

    public function testUFVazia()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);

        $this->expectException(\Exception::class);

        $uf = $endereco->buscarUF('XX');
    }
}
