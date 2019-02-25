<?php 

namespace App\DAO;

use App\Model\EnderecoModel;
use App\Entidades\Endereco;
use App\Model\UFModel;

class EnderecoDAO
{
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

    public function criar(Endereco $endereco)
    { 
        $this->model->pessoa_id = $endereco->pessoa_id;
        $this->model->uf_id = $this->buscarUF($endereco->uf);
        $this->model->logradouro = $endereco->logradouro;
        $this->model->complemento = $endereco->complemento;
        $this->model->bairro = $endereco->bairro;
        $this->model->cidade = $endereco->cidade;
        $this->model->cep = $endereco->cep;

        return $this->model->save();

        //$uf_id = $this->buscarUF($endereco->uf);

        /*
        if (empty($uf_id)) {
            throw new \Exception( 'UF não encontrada', 500);
        }
        */
    }

    public function atualizar(Endereco $endereco)
    {
        $this->model = EnderecoModel::find($endereco->id);

        $this->model->pessoa_id = $endereco->pessoa_id;
        $this->model->uf_id = $this->buscarUF($endereco->uf);
        $this->model->logradouro = $endereco->logradouro;
        $this->model->complemento = $endereco->complemento;
        $this->model->bairro = $endereco->bairro;
        $this->model->cidade = $endereco->cidade;
        $this->model->cep = $endereco->cep;

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