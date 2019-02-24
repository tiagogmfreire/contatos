<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PessoaModel;
use App\BO\PessoaBO;
use App\DAO\PessoaDAO;
use App\Entidades\Pessoa;
use Nexmo\Client\Response\Response;

class PessoaController extends Controller
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
    public function store(Request $request, PessoaBO $pessoaBO, Pessoa $pessoa)
    { 
        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $this->filtrarNumero($request->input('cpf'));
        $pessoa->email = $request->input('email');        
        $pessoa->telefone = $this->filtrarNumero($request->input('telefone'));

        $this->validar($pessoa);

        $resultado = $pessoaBO->criar($pessoa);

        return $this->retorno(
            $resultado,
            'Pessoa cadastrada com sucesso!',
            'Erro ao cadastrar pessoa!'
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    public function validar(Pessoa $pessoa)
    {
        $msg = '';

        if (empty($pessoa->nome)) {
           $msg .= 'O parâmetro "nome" não pode ser vazio; ';
        }

        if (empty($pessoa->cpf)) {
            $msg .= 'O Parmâmetro "cpf" não pode ser vazio; ';            
        }

        if (empty($pessoa->email)) {
            $msg .= 'O Parmâmetro "email" não pode ser vazio; ';            
        }

        //usando extensão multibyte para contar corretamente o Nº de caracteres de uma string UTF-8
        if (mb_strlen($pessoa->cpf) != 11) {
            $msg .= 'O Parmâmetro "cpf" deve ter 11 caracteres (pontos e traços são ignorados); ';            
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
