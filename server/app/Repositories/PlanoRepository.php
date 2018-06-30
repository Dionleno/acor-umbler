<?php

namespace App\Repositories;

use App\Models\Plano;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PlanoRepository
 * @package App\Repositories
 * @version June 14, 2018, 1:38 am UTC
 *
 * @method Plano findWithoutFail($id, $columns = ['*'])
 * @method Plano find($id, $columns = ['*'])
 * @method Plano first($columns = ['*'])
*/
class PlanoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vigencia',
        'valor',
        'tipo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Plano::class;
    }

    public function findBy($attribute, $value)
    {
        $query = Plano::where($attribute, $value)->get();
        return $query;
    }
}
