<?php

namespace App\Repositories;

use App\Models\Servico;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ServicoRepository
 * @package App\Repositories
 * @version June 14, 2018, 1:27 am UTC
 *
 * @method Servico findWithoutFail($id, $columns = ['*'])
 * @method Servico find($id, $columns = ['*'])
 * @method Servico first($columns = ['*'])
*/
class ServicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'titulo',
        'descricao'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Servico::class;
    }
}
