<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Projeto
 * @package App\Models
 * @version June 10, 2018, 4:49 pm UTC
 *
 * @property string nome
 * @property string objetivo
 * @property string descricao
 * @property string link
 */
class Projeto extends Model
{
    use SoftDeletes;

    public $table = 'projetos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nome',
        'objetivo',
        'descricao',
        'link'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nome' => 'string',
        'objetivo' => 'string',
        'descricao' => 'string',
        'link' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'objetivo' => 'required',
        'descricao' => 'required',
        'link' => 'required'
    ];

    
}
