<?php

namespace App\Repositories;

use App\Models\Projeto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjetoRepository
 * @package App\Repositories
 * @version June 10, 2018, 4:49 pm UTC
 *
 * @method Projeto findWithoutFail($id, $columns = ['*'])
 * @method Projeto find($id, $columns = ['*'])
 * @method Projeto first($columns = ['*'])
*/
class ProjetoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'objetivo',
        'descricao',
        'link'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Projeto::class;
    }
}
