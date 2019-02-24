<?php 

namespace App\BO;

use App\DAO\PessoaDAO;
use App\Model\PessoaModel;

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

    public function criar(PessoaModel $pessoaModel)
    { 
        return $this->dao->criar($pessoaModel);
    }

    public function atualizar(PessoaModel $pessoaModel)
    {   
        return $this->dao->atualizar($pessoaModel);
    }

    public function excluir($id)
    {
        return $this->dao->excluir($id);
    }
}