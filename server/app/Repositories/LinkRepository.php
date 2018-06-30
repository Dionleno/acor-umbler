<?php

namespace App\Repositories;

use App\Models\Link;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LinkRepository
 * @package App\Repositories
 * @version June 14, 2018, 1:30 am UTC
 *
 * @method Link findWithoutFail($id, $columns = ['*'])
 * @method Link find($id, $columns = ['*'])
 * @method Link first($columns = ['*'])
*/
class LinkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'titulo',
        'link'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Link::class;
    }
}
