<?php 

namespace App\BO;

use App\DAO\PessoaDAO;
use App\Model\PessoaModel;
use App\Entidades\Pessoa;

class PessoaBO
{
    protected $dao;

    public function __construct(PessoaDAO $pessoaDAO)
    {
        $this->dao = $pessoaDAO;
    }

    public function listar()
    { 
        return $this->dao->listar();
    }

    public function detalhar($id)
    {
        return $this->dao->detalhar($id);
    }

    public function criar(Pessoa $pessoa)
    { 
        return $this->dao->criar($pessoa);
    }

    public function atualizar(Pessoa $pessoa)
    {   
        return $this->dao->atualizar($pessoa);
    }

    public function excluir($id)
    {
        return $this->dao->excluir($id);
    }
}