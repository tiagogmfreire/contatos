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
    public function index(EnderecoBO $enderecoBO)
    {
        $enderecos = $enderecoBO->listar();

        return response()->json($enderecos);
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
    public function show($id, EnderecoBO $enderecoBO)
    {
        $pessoa = $enderecoBO->detalhar($id);

        return response()->json($pessoa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnderecoBO $enderecoBO, Endereco $endereco, $id)
    {
        $endereco->id = $id;
        $endereco->pessoa_id = $request->input('pessoa_id');
        $endereco->uf = $request->input('uf');
        $endereco->logradouro = $request->input('logradouro');
        $endereco->complemento = $request->input('complemento');
        $endereco->bairro = $request->input('bairro');
        $endereco->cidade = $request->input('cidade');
        $endereco->cep = $this->filtrarNumero($request->input('cep'));

        $this->validar($endereco, true);

        $resultado = $enderecoBO->atualizar($endereco);

        return $this->retorno(
            $resultado,
            'Endereco atualizado com sucesso!',
            'Erro ao atualizar endereco!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, EnderecoBO $enderecoBO)
    {
        $resultado = $enderecoBO->excluir($id);

        /*
        if (empty($id)) {
            throw new \Exception("ID da pessoa é obrigatório", 400);
        }
        */

        return $this->retorno(
            $resultado,
            'Endereço excluído com sucesso!',
            'Erro ao excluir endereço!'
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

        if ($criar && empty($endereco->id)) {
            $msg .= 'ID do endereço não informado; ';            
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
