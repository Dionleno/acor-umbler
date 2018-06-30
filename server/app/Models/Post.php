<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models
 * @version May 31, 2018, 12:06 am UTC
 *
 * @property string titulo
 * @property string linha_fina
 * @property string texto
 * @property integer cobertura_id
 * @property integer categoria_id
 */
class Post extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo',
        'linha_fina',
        'texto',
        'image',
        'banner',
        'cobertura_id',
        'categoria_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string',
        'linha_fina' => 'string',
        'texto' => 'string',
        'image' => 'string',
        'banner' => 'string',
        'cobertura_id' => 'integer',
        'categoria_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'linha_fina' => 'required',
        'texto' => 'required',
        'image' => 'required',
        'banner' => 'required',
        'categoria_id' => 'required'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
