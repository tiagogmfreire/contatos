<?php 

namespace App\Entidades;

use App\Model\EnderecoModel;
use App\Model\UFModel;
use App\Exceptions\CustomException;

/**
 * Classe para a entidade Endereço.
 */
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

    /**
     * Construtor utilizando injeção de dependência.
     *
     * @param EnderecoModel $enderecoModel
     */
    public function __construct(EnderecoModel $enderecoModel)
    {
        $this->model = $enderecoModel;
    }

    /**
     * Método para listar todos os endereços.
     *
     * @return array
     */
    public function listar()
    { 
        return EnderecoModel::all();
    }

    /**
     * Método para detalhar endereço
     *
     * @param int $id
     * @return EnderecoModel
     */
    public function detalhar($id)
    {
        if (empty($id)) {
            throw new CustomException("ID do endereço não informado", 400);
        }

        return EnderecoModel::find($id);
    }

    /**
     * Método para cadastrar um endereço.
     *
     * @return boolean
     */
    public function criar()
    { 
        if (empty($this->pessoa_id)) {
            throw new CustomException('O parâmetro "pessoa_id" é inválido', 400);
        }

        if (empty($this->logradouro)) {
            throw new CustomException('O parâmetro "logradouro" não pode ser vazio', 400);
        }

        if (empty($this->bairro)) {
            throw new CustomException('O parâmetro "bairro" não pode ser vazio', 400);
        }

        if (empty($this->cidade)) {
            throw new CustomException('O parâmetro "cidade" não pode ser vazio', 400);
        }

        if (empty($this->cep)) {
            throw new CustomException('O parâmetro "cep" não pode ser vazio', 400);
        }

        $this->model->pessoa_id = $this->pessoa_id;
        $this->model->uf_id = $this->buscarUF($this->uf);
        $this->model->logradouro = $this->logradouro;
        $this->model->complemento = $this->complemento;
        $this->model->bairro = $this->bairro;
        $this->model->cidade = $this->cidade;
        $this->model->cep = $this->cep;

        return $this->model->save();
    }

    /**
     * Método para atualizar um endereço
     *
     * @return boolean
     */
    public function atualizar()
    {
        $this->model = EnderecoModel::find($this->id);

        if (empty($this->model)) {
            throw new CustomException('Endereço não encontrado', 400);
        }

        if (empty($this->pessoa_id)) {
            throw new CustomException('O parâmetro "pessoa_id" é inválido', 400);
        }

        if (empty($this->logradouro)) {
            throw new CustomException('O parâmetro "logradouro" não pode ser vazio', 400);
        }

        if (empty($this->bairro)) {
            throw new CustomException('O parâmetro "bairro" não pode ser vazio', 400);
        }

        if (empty($this->cidade)) {
            throw new CustomException('O parâmetro "cidade" não pode ser vazio', 400);
        }

        if (empty($this->cep)) {
            throw new CustomException('O parâmetro "cep" não pode ser vazio', 400);
        }

        $this->model->pessoa_id = $this->pessoa_id;
        $this->model->uf_id = $this->buscarUF($this->uf);
        $this->model->logradouro = $this->logradouro;
        $this->model->complemento = $this->complemento;
        $this->model->bairro = $this->bairro;
        $this->model->cidade = $this->cidade;
        $this->model->cep = $this->cep;

        return $this->model->save();
    }
    
    /**
     * Método para excluir um endereço(logicamente)
     *
     * @param int $id
     * @return boolean
     */
    public function excluir($id)
    {
        $this->model = EnderecoModel::find($id);

        if (empty($this->model)) {
            throw new CustomException('Endereço não encontrado', 400);
        }

        //realizando exclusão lógica do registro
        $this->model->delete();

        //persistindo alterações
        return $this->model->save();
    }

    /**
     * Método para recuperar o id da tabela de domínio
     * de UF.
     *
     * @param string $uf
     * @return int
     */
    public function buscarUF($uf)
    {
        $uf = UFModel::where('uf',strtoupper($uf))->first();

        if (empty($uf)) {
            throw new CustomException('A UF informada não é valida!', 400);
        }

        return $uf->id;
    }
}