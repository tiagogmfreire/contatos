<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\EnderecoModel;
use App\Entidades\Endereco;
use App\Exceptions\CustomException;

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

        $this->expectException(CustomException::class);

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

        $this->expectException(CustomException::class);

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

        $this->expectException(CustomException::class);

        $endereco->excluir(0);
    }

    public function testUFVazia()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);

        $this->expectException(CustomException::class);

        $uf = $endereco->buscarUF('XX');
    }

    public function testCriarPessoaIdVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->uf = 'DF';

        $this->expectException(CustomException::class);

        $endereco->criar();        
    }

    public function testCriarUfVazia()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->pessoa_id = 1;
        $endereco->uf = '';

        $this->expectException(CustomException::class);

        $endereco->criar();        
    }

    public function testCriarLogradrouroVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->pessoa_id = 1;
        $endereco->uf = 'DF';        

        $this->expectException(CustomException::class);

        $endereco->criar();        
    }

    public function testCriarBairroVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->pessoa_id = 1;
        $endereco->uf = 'DF';     
        $endereco->logradouro = 'teste';   

        $this->expectException(CustomException::class);

        $endereco->criar();        
    }

    public function testCriarCidadeVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->pessoa_id = 1;
        $endereco->uf = 'DF';     
        $endereco->logradouro = 'teste';   
        $endereco->bairro = 'teste';   

        $this->expectException(CustomException::class);

        $endereco->criar();        
    }

    public function testCriarCepVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->pessoa_id = 1;
        $endereco->uf = 'DF';     
        $endereco->logradouro = 'teste';   
        $endereco->bairro = 'teste';   
        $endereco->cidade = 'teste';   

        $this->expectException(CustomException::class);

        $endereco->criar();        
    }

    public function testAtualizarPessoaIdVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->id = 1;

        $this->expectException(CustomException::class);

        $endereco->atualizar();        
    }

    public function testAtualizarLogradrouroVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->id = 1;
        $endereco->pessoa_id = 1;        
        $endereco->uf = 'DF';        

        $this->expectException(CustomException::class);

        $endereco->atualizar()();        
    }

    public function testAtualizarBairroVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->id = 1;
        $endereco->pessoa_id = 1;
        $endereco->uf = 'DF';     
        $endereco->logradouro = 'teste';   

        $this->expectException(CustomException::class);

        $endereco->atualizar()();        
    }

    public function testAtualizarCidadeVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->id = 1;
        $endereco->pessoa_id = 1;
        $endereco->uf = 'DF';     
        $endereco->logradouro = 'teste';   
        $endereco->bairro = 'teste';   

        $this->expectException(CustomException::class);

        $endereco->atualizar();        
    }

    public function testAtualizarCepVazio()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->id = 1;
        $endereco->pessoa_id = 1;
        $endereco->uf = 'DF';     
        $endereco->logradouro = 'teste';   
        $endereco->bairro = 'teste';   
        $endereco->cidade = 'teste';   

        $this->expectException(CustomException::class);

        $endereco->atualizar();        
    }

    public function testAtualizarUfVazia()
    {
        $enderecoModel = new EnderecoModel();
        $endereco = new Endereco($enderecoModel);
        
        $endereco->id = 1;
        $endereco->pessoa_id = 1;
           
        $endereco->logradouro = 'teste';   
        $endereco->bairro = 'teste';   
        $endereco->cidade = 'teste';  
        $endereco->cep = '70660074';  

        $this->expectException(CustomException::class);

        $endereco->criar();        
    }
}
