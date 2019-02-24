<?php 

namespace App\DAO;

use App\Model\PessoaModel;
use App\Entidades\Pessoa;

class PessoaDAO
{
    protected $model;

    public function __construct(PessoaModel $pessoaModel)
    {
        $this->model = $pessoaModel;
    }

    public function listar()
    {         
        return PessoaModel::all();
    }

    public function detalhar($id)
    {

    }

    public function criar(Pessoa $pessoa)
    { 
        $this->model->nome = $pessoa->nome;
        $this->model->cpf = $pessoa->cpf;
        $this->model->email = $pessoa->email;
        $this->model->telefone = $pessoa->telefone;

        return $this->model->save();
    }

    public function atualizar(PessoaModel $pessoaModel)
    {

    }
    
    public function excluir($id)
    {

    }
}