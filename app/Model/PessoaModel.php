<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Classe de modelo para a tabela pessoa.
 */
class PessoaModel extends Model
{
    use SoftDeletes;

    protected $table = 'uf';    
    protected $fillable = array('*');
    protected $guarded = ['id'];
}
