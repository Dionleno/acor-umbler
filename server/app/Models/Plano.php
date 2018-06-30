<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plano
 * @package App\Models
 * @version June 14, 2018, 1:38 am UTC
 *
 * @property string vigencia
 * @property integer valor
 * @property string tipo
 */
class Plano extends Model
{
    use SoftDeletes;

    public $table = 'planos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'vigencia',
        'valor',
        'tipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'vigencia' => 'string',
        'valor' => 'integer',
        'tipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'vigencia' => 'required',
        'valor' => 'required',
        'tipo' => 'required'
    ];

    
}
