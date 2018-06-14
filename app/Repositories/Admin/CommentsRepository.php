<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Comment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class commentsRepository
 * @package App\Repositories\Admin
 * @version April 23, 2018, 3:11 pm UTC
 *
 * @method Comment findWithoutFail($id, $columns = ['*'])
 * @method Comment find($id, $columns = ['*'])
 * @method Comment first($columns = ['*'])
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
