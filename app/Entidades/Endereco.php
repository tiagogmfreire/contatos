<?php 

namespace App\Entidades;

use App\Model\EnderecoModel;
use App\Model\UFModel;

class Endereco extends \stdClass
{
    public $id;
    public $pessoa_id;
    public $uf;
    public $uf_id;
    public $logradouro;
    public $complemento;
    public $bairro;
    public $cidade;
    public $cep;

    protected $model;

    public function __construct(EnderecoModel $enderecoModel)
    {
        $this->model = $enderecoModel;
    }

    public function listar()
    { 
        return EnderecoModel::all();
    }

    public function detalhar($id)
    {
        return EnderecoModel::find($id);
    }

    public function criar()
    { 
        $this->model->pessoa_id = $this->pessoa_id;
        $this->model->uf_id = $this->buscarUF($this->uf);
        $this->model->logradouro = $this->logradouro;
        $this->model->complemento = $this->complemento;
        $this->model->bairro = $this->bairro;
        $this->model->cidade = $this->cidade;
        $this->model->cep = $this->cep;

        return $this->model->save();
    }

    public function atualizar()
    {
        $this->model = EnderecoModel::find($this->id);

        $this->model->pessoa_id = $this->pessoa_id;
        $this->model->uf_id = $this->buscarUF($this->uf);
        $this->model->logradouro = $this->logradouro;
        $this->model->complemento = $this->complemento;
        $this->model->bairro = $this->bairro;
        $this->model->cidade = $this->cidade;
        $this->model->cep = $this->cep;

        return $this->model->save();
    }
    
    public function excluir($id)
    {
        $this->model = EnderecoModel::find($id);

        //realizando exclusão lógica do registro
        $this->model->delete();

        //persistindo alterações
        return $this->model->save();
    }

    protected function buscarUF($uf)
    {
        $uf = UFModel::where('uf',$uf)->first();

        return $uf->id;
    }
}