<?php

namespace App\Repositories\Admin;

use App\Models\Admin\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\Admin
 * @version May 2, 2018, 7:42 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'subscription'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
