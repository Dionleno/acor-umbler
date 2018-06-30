<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Evento
 * @package App\Models
 * @version June 10, 2018, 8:04 pm UTC
 *
 * @property string logo
 * @property string titulo
 * @property string descricao
 * @property date data
 * @property string local
 * @property string horario
 * @property integer valor
 * @property string site
 * @property string status
 */
class Evento extends Model
{
    use SoftDeletes;

    public $table = 'eventos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'logo',
        'titulo',
        'descricao',
        'data',
        'local',
        'horario',
        'valor',
        'site',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'logo' => 'string',
        'titulo' => 'string',
        'descricao' => 'string',
        'data' => 'date',
        'local' => 'string',
        'horario' => 'string',
        'valor' => 'string',
        'site' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'logo' => 'required',
        'titulo' => 'required',
        'descricao' => 'required',
        'data' => 'required',
        'local' => 'required',
        'horario' => 'required',
        'valor' => 'required',
        'site' => 'required',
        'status' => 'required'
    ];

    
}
