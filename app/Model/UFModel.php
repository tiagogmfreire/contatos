<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Classe de modelo para a tabela de Domínio de UFs.
 */
class UFModel extends Model
{
    use SoftDeletes;

    protected $table = 'uf';    
    protected $fillable = array('*');
    protected $guarded = ['id'];
}
