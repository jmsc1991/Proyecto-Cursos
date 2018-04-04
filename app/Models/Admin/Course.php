<?php

namespace App\Models\Admin;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 * @package App\Models\Admin
 * @version April 4, 2018, 11:58 am UTC
 *
 * @property string title
 * @property string excerpt
 * @property string description
 * @property ninteger price
 * @property integer category_id
 * @property integer owner
 * @property string learn
 * @property string requirements
 */
class Course extends Model
{
    use SoftDeletes;

    public $table = 'courses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'excerpt',
        'description',
        'price',
        'category_id',
        'owner',
        'learn',
        'requirements'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'excerpt' => 'string',
        'description' => 'string',
        'category_id' => 'integer',
        'owner' => 'integer',
        'learn' => 'string',
        'requirements' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'excerpt' => 'required',
        'description' => 'required',
        'price' => 'required',
        'learn' => 'required',
        'requirements' => 'required'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner');
    }
    
}
