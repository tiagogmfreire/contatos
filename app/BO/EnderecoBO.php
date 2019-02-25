<?php 

namespace App\BO;

use App\DAO\EnderecoDAO;
use App\Model\EnderecoModel;
use App\Entidades\Endereco;

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

    public function criar(Endereco $endereco)
    { 
        return $this->dao->criar($endereco);
    }

    public function atualizar(Endereco $endereco)
    {   
        return $this->dao->atualizar($endereco);
    }

    public function excluir($id)
    {
        return $this->dao->excluir($id);
    }
}