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

        $PessoaBO = new PessoaBO(new PessoaDAO());

        $resultado = $PessoaBO->criar($pessoa);

        $status = '';
        $msg = '';

        if ($resultado) {
            $status = 200;
            $msg = 'Pessoa cadastrada com sucesso!';
        } else {
            $msg = 'Erro ao cadastrar pessoa!';
            $status = 500;
        }

        return response()->json(
            ['msg' => $msg], 
            $status
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
}
