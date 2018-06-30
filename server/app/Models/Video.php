<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Video
 * @package App\Models
 * @version June 10, 2018, 7:44 pm UTC
 *
 * @property string titulo
 * @property string descricao
 * @property string link
 * @property string status
 */
class Video extends Model
{
    use SoftDeletes;

    public $table = 'videos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo',
        'descricao',
        'link',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string',
        'descricao' => 'string',
        'link' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'descricao' => 'required',
        'link' => 'required',
        'status' => 'required'
    ];

    
}
