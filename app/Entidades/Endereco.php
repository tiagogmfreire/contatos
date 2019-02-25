<?php 

namespace App\Entidades;

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
}