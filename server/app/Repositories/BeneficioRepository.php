<?php

namespace App\Repositories;

use App\Models\Beneficio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BeneficioRepository
 * @package App\Repositories
 * @version June 14, 2018, 1:35 am UTC
 *
 * @method Beneficio findWithoutFail($id, $columns = ['*'])
 * @method Beneficio find($id, $columns = ['*'])
 * @method Beneficio first($columns = ['*'])
*/
class BeneficioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'titulo',
        'descricao',
        'tipo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Beneficio::class;
    }
    public function findBy($attribute, $value)
    {
        $query = Beneficio::where($attribute, $value)->get();
        return $query;
    }
}
