<?php 

namespace App\Entidades;

use App\Model\PessoaModel;
use App\Exceptions\CustomException;

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
        if (empty($id)) {
            throw new CustomException("ID da pessoa não informado", 400);
        }

        return PessoaModel::find($id)->with('enderecos')->first();
    }

    /**
     * Método para cadastrar uma nova pessoa no banco
     *
     * @return boolean
     */
    public function criar()
    { 
        if (empty($this->nome)) {
            throw new CustomException('Parâmetro "nome" não pode ser vazio!', 400);
        }

        $this->cpf = $this->filtrarNumero($this->cpf);
        if (empty($this->cpf) || mb_strlen($this->cpf) != 11) {
            throw new CustomException('Parâmetro "cpf" inválido!', 400);
        }

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
            throw new CustomException('Pessoa não encontrada', 400);
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
            throw new CustomException('Pessoa não encontrada', 400);
        }

        //realizando exclusão lógica do registro
        $this->model->delete();

        //persistindo alterações
        return $this->model->save();
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