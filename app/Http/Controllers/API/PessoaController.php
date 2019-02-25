<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BO\PessoaBO;
use App\Entidades\Pessoa;
use Nexmo\Client\Response\Response;

class PessoaController extends Controller
{
    /**
     * Método que lista todas as pessoas
     *
     * @param PessoaBO $pessoaBO
     * @return void
     */
    public function index(PessoaBO $pessoaBO)
    {
        $pessoas = $pessoaBO->listar();

        return response()->json($pessoas);
    }

    /**
     * Método que cadastra uma pessoa
     *
     * @param Request $request
     * @param PessoaBO $pessoaBO
     * @param Pessoa $pessoa
     * @return void
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
     * Método que detalha uma pessoa
     *
     * @param int $id
     * @param PessoaBO $pessoaBO
     * @return void
     */
    public function show($id, PessoaBO $pessoaBO)
    {
        $pessoa = $pessoaBO->detalhar($id);

        return response()->json($pessoa);
    }

    /**
     * Método que atualiza uma pessoa
     *
     * @param Request $request
     * @param PessoaBO $pessoaBO
     * @param Pessoa $pessoa
     * @param int $id
     * @return void
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
     * Método que faz a remoção lógica de uma pessoa
     *
     * @param int $id
     * @param PessoaBO $pessoaBO
     * @return void
     */
    public function destroy($id, PessoaBO $pessoaBO)
    {
        $resultado = $pessoaBO->excluir($id);

        return $this->retorno(
            $resultado,
            'Pessoa excluída com sucesso!',
            'Erro ao excluir pessoa!'
        );
    }

    /**
     * Método para tratar o retorno da requisição
     *
     * @param boolean $resultado
     * @param string $sucesso
     * @param string $erro
     * @return void
     */
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

    /**
     * Método para validar parâmetros
     *
     * @param Pessoa $pessoa
     * @param boolean $criar
     * @return void
     */
    public function validar(Pessoa $pessoa, $criar = false)
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

        if ($criar && empty($pessoa->id)) {
            $msg .= 'ID da pessoa não informado; ';            
        }

        //se a mensagem de validação não for vazia, dispara uma exceção
        if (!empty($msg)) {
            throw new \Exception($msg, 400);
        }
    }

    /**
     * Método para remover caracteres não numéricos
     * de uma string
     *
     * @param string $numero
     * @return void
     */
    public function filtrarNumero($numero)
    {
        return preg_replace('/\D/', '', $numero);
    }
}
