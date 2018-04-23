<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Categories;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class categoriesRepository
 * @package App\Repositories\Admin
 * @version April 23, 2018, 3:11 pm UTC
 *
 * @method categories findWithoutFail($id, $columns = ['*'])
 * @method categories find($id, $columns = ['*'])
 * @method categories first($columns = ['*'])
*/
class CategoriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return categories::class;
    }
}
