<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BO\EnderecoBO;
use App\Entidades\Endereco;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PessoaBO $pessoaBO)
    {
        $pessoas = $pessoaBO->listar();

        return response()->json($pessoas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EnderecoBO $enderecoBO, Endereco $endereco)
    {
        $endereco->pessoa_id = $request->input('pessoa_id');
        $endereco->uf = $request->input('uf');
        $endereco->logradouro = $request->input('logradouro');
        $endereco->complemento = $request->input('complemento');
        $endereco->bairro = $request->input('bairro');
        $endereco->cidade = $request->input('cidade');
        $endereco->cep = $this->filtrarNumero($request->input('cep'));

        $this->validar($endereco);

        $resultado = $enderecoBO->criar($endereco);

        return $this->retorno(
            $resultado,
            'Endereco cadastrado com sucesso!',
            'Erro ao cadastrar endereco!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PessoaBO $pessoaBO)
    {
        $pessoa = $pessoaBO->detalhar($id);

        return response()->json($pessoa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PessoaBO $pessoaBO, Pessoa $pessoa, $id)
    {
        $pessoa->id = $id;
        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $this->filtrarNumero($request->input('cpf'));
        $pessoa->email = $request->input('email');        
        $pessoa->telefone = $this->filtrarNumero($request->input('telefone'));

        $this->validar($pessoa, true);

        $resultado = $pessoaBO->atualizar($pessoa);

        return $this->retorno(
            $resultado,
            'Pessoa atualizada com sucesso!',
            'Erro ao atualizar pessoa!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PessoaBO $pessoaBO)
    {
        $resultado = $pessoaBO->excluir($id);

        /*
        if (empty($id)) {
            throw new \Exception("ID da pessoa é obrigatório", 400);
        }
        */

        return $this->retorno(
            $resultado,
            'Pessoa excluída com sucesso!',
            'Erro ao excluir pessoa!'
        );
    }

    public function retorno($resultado, $sucesso = 'Operação realizada com sucesso!', $erro = 'Erro ao realizar operação')
    {
        $status = '';
        $msg = '';

        if ($resultado) {
            $status = 200;
            $msg = $sucesso;
        } else {
            $msg = $erro;
            $status = 500;
        }

        return response()->json(
            ['msg' => $msg], 
            $status
        ); 
    }

    public function validar(Endereco $endereco, $criar = false)
    {
        $msg = '';

        if (empty($endereco->pessoa_id)) {
            $msg .= 'Parâmetro "pessoa_id" Não pode ser vazio; ';
        }

        if (empty($endereco->uf)) {
            $msg .= 'Parâmetro "uf" Não pode ser vazio; ';
        }

        if (empty($endereco->logradouro)) {
            $msg .= 'Parâmetro "logradouro" Não pode ser vazio; ';
        }

        if (empty($endereco->bairro)) {
            $msg .= 'Parâmetro "bairro" Não pode ser vazio; ';
        }

        if (empty($endereco->cidade)) {
            $msg .= 'Parâmetro "cidade" Não pode ser vazio; ';
        }

        if (empty($endereco->cep)) {
            $msg .= 'Parâmetro "cep" Não pode ser vazio; ';
        }

        //se a mensagem de validação não for vazia, dispara uma exceção
        if (!empty($msg)) {
            throw new \Exception($msg, 400);
        }
    }

    public function filtrarNumero($numero)
    {
        return preg_replace('/\D/', '', $numero);
    }
}
