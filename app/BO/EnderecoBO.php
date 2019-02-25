<?php 

namespace App\BO;

use App\DAO\EnderecoDAO;
use App\Model\EnderecoModel;
use App\Entidades\Endereco;

class EnderecoBO
{
    protected $dao;

    /**
     * Construtor
     *
     * @param EnderecoDAO $enderecoDAO
     */
    public function __construct(EnderecoDAO $enderecoDAO)
    {
        $this->dao = $enderecoDAO;
    }

    /**
     * Lista todos os endereços
     *
     * @return array
     */
    public function listar()
    { 
        return $this->dao->listar();
    }

    /**
     * detalha um endereço
     *
     * @param int $id
     * @return EnderecoModel
     */
    public function detalhar($id)
    {
        return $this->dao->detalhar($id);
    }

    /**
     * Cria um novo endereço
     *
     * @param Endereco $endereco
     * @return boolean
     */
    public function criar(Endereco $endereco)
    { 
        return $this->dao->criar($endereco);
    }

    /**
     * Atualiza um endereço
     *
     * @param Endereco $endereco
     * @return boolean
     */
    public function atualizar(Endereco $endereco)
    {   
        return $this->dao->atualizar($endereco);
    }

    /**
     * Faz a exclusão lógica de um endereço
     *
     * @param int $id
     * @return void
     */
    public function excluir($id)
    {
        return $this->dao->excluir($id);
    }
}