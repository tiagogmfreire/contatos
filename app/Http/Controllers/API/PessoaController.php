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
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $pessoa = new Pessoa();

        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $request->input('cpf');
        $pessoa->email = $request->input('email');
        $pessoa->email = $request->input('email');
        $pessoa->telefone = $request->input('telefone');

        $this->validar($pessoa);

        $PessoaBO = new PessoaBO(new PessoaDAO());

        $resultado = $PessoaBO->criar($pessoa);

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
    public function show($id)
    {
        //
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
        if (empty($pessoa->nome)) {
            throw new \Exception('O Parmâmetro "nome" não pode ser vazio', 400);
        }

        if (empty($pessoa->cpf)) {
            throw new \Exception('O Parmâmetro "cpf" não pode ser vazio', 400);
        }

        if (empty($pessoa->email)) {
            throw new \Exception('O Parmâmetro "email" não pode ser vazio', 400);
        }
    }
}
