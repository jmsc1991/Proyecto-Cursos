<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models\Admin
 * @version May 2, 2018, 7:42 am UTC
 *
 * @property string name
 * @property string email
 * @property string subscription
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'subscription'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'subscription' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required'
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Course::class, 'user_courses');
    }
    
}
