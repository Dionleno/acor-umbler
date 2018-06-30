<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Servico
 * @package App\Models
 * @version June 14, 2018, 1:27 am UTC
 *
 * @property string titulo
 * @property string descricao
 */
class Servico extends Model
{
    use SoftDeletes;

    public $table = 'servicos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo',
        'descricao'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string',
        'descricao' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'descricao' => 'required'
    ];

    
}
