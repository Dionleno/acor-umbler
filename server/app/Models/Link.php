<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Link
 * @package App\Models
 * @version June 14, 2018, 1:30 am UTC
 *
 * @property string titulo
 * @property string link
 */
class Link extends Model
{
    use SoftDeletes;

    public $table = 'links';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo',
        'link'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string',
        'link' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required',
        'link' => 'required'
    ];

    
}
