<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Beneficio
 * @package App\Models
 * @version June 14, 2018, 1:35 am UTC
 *
 * @property string titulo
 * @property string descricao
 * @property string tipo
 */
class Beneficio extends Model
{
    use SoftDeletes;

    public $table = 'beneficios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo',
        'descricao',
        'tipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string',
        'descricao' => 'string',
        'tipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'descricao' => 'required',
        'tipo' => 'required'
    ];

    
}
