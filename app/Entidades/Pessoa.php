<?php 

namespace App\Entidades;

use App\Model\PessoaModel;

/**
 * Classe para a entidade Pessoa
 */
class Pessoa extends \stdClass
{
    public $id;
    public $nome;
    public $cpf;
    public $email;
    public $telefone;

    protected $model;

    /**
     * Construtor utilizando injeção de dependência.
     *
     * @param PessoaModel $pessoaModel
     */
    public function __construct(PessoaModel $pessoaModel)
    {
        $this->model = $pessoaModel;
    }

    /**
     * Método para listar todas as Pessoas cadastradas
     *
     * @return array
     */
    public function listar()
    {         
        return PessoaModel::all();
    }

    /**
     * Método para detalhar uma pessoa cadastrada
     *
     * @param int $id
     * @return PessoaModel
     */
    public function detalhar($id)
    {
        return PessoaModel::find($id)->with('enderecos')->first();
    }

    /**
     * Método para cadastrar uma nova pessoa no banco
     *
     * @return boolean
     */
    public function criar()
    { 
        $this->model->nome = $this->nome;
        $this->model->cpf = $this->cpf;
        $this->model->email = $this->email;
        $this->model->telefone = $this->telefone;

        return $this->model->save();
    }

    /**
     * Método para atualizar o cadastro de uma pessoa
     *
     * @return boolean
     */
    public function atualizar()
    {
        $this->model = PessoaModel::find($this->id);

        if (empty($this->model)) {
            throw new \Exception('Pessoa não encontrada', 400);
        }

        $this->model->nome = $this->nome;
        $this->model->cpf = $this->cpf;
        $this->model->email = $this->email;
        $this->model->telefone = $this->telefone;

        return $this->model->save();
    }
    
    /**
     * Método que faz a exclusão lógica de uma pessoa
     *
     * @param int $id
     * @return boolean
     */
    public function excluir($id)
    {
        $this->model = PessoaModel::find($id);

        if (empty($this->model)) {
            throw new \Exception('Pessoa não encontrada', 400);
        }

        //realizando exclusão lógica do registro
        $this->model->delete();

        //persistindo alterações
        return $this->model->save();
    }
}