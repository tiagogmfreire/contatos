<?php 

namespace App\DAO;

use App\Model\PessoaModel;
use App\Entidades\Pessoa;

class PessoaDAO
{
    public function listar()
    { 

    }

    public function detalhar($id)
    {

    }

    public function criar(Pessoa $pessoa)
    { 
        $pessoaModel = new PessoaModel();

        $pessoaModel->nome = $pessoa->nome;
        $pessoaModel->cpf = $pessoa->cpf;
        $pessoaModel->email = $pessoa->email;
        $pessoaModel->telefone = $pessoa->telefone;

        return $pessoaModel->save();
    }

    public function atualizar(PessoaModel $pessoaModel)
    {

    }
    
    public function excluir($id)
    {

    }
}