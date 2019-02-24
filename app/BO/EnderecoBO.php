<?php 

namespace App\BO;

use App\DAO\EnderecoDAO;
use App\Model\EnderecoModel;

class EnderecoBO
{
    protected $dao;

    public function __construct(EnderecoDAO $enderecoDAO)
    {
        $this->dao = $enderecoDAO;
    }

    public function listar()
    { 
        return $this->dao->listar();
    }

    public function detalhar($id)
    {
        return $this->dao->detalhar($id);
    }

    public function criar(EnderecoModel $enderecoModel)
    { 
        return $this->dao->criar($enderecoModel);
    }

    public function atualizar(EnderecoModel $enderecoModel)
    {   
        return $this->dao->atualizar($enderecoModel);
    }

    public function excluir($id)
    {
        return $this->dao->excluir($id);
    }
}