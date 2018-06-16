<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Video;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class videoRepository
 * @package App\Repositories\Admin
 * @version April 23, 2018, 3:11 pm UTC
 *
 * @method Video findWithoutFail($id, $columns = ['*'])
 * @method Video find($id, $columns = ['*'])
 * @method Video first($columns = ['*'])
 */
class VideoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'url',
        'course_id',
        'free',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Video::class;
    }
}
