<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Comment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class categoriesRepository
 * @package App\Repositories\Admin
 * @version April 23, 2018, 3:11 pm UTC
 *
 * @method Category findWithoutFail($id, $columns = ['*'])
 * @method Category find($id, $columns = ['*'])
 * @method Category first($columns = ['*'])
 */
class CommentsRepository extends BaseRepository
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
        return Comment::class;
    }
}
