<?php 

namespace App\Entidades;

use App\Model\PessoaModel;

class Pessoa extends \stdClass
{
    public $id;
    public $nome;
    public $cpf;
    public $email;
    public $telefone;

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
        return PessoaModel::find($id)->with('enderecos')->first();
    }

    public function criar()
    { 
        $this->model->nome = $this->nome;
        $this->model->cpf = $this->cpf;
        $this->model->email = $this->email;
        $this->model->telefone = $this->telefone;

        return $this->model->save();
    }

    public function atualizar()
    {
        $this->model = PessoaModel::find($this->id);

        $this->model->nome = $this->nome;
        $this->model->cpf = $this->cpf;
        $this->model->email = $this->email;
        $this->model->telefone = $this->telefone;

        return $this->model->save();
    }
    
    public function excluir($id)
    {
        $this->model = PessoaModel::find($id);

        //realizando exclusão lógica do registro
        $this->model->delete();

        //persistindo alterações
        return $this->model->save();
    }
}