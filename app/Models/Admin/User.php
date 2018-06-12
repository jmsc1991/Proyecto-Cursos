<?php

namespace App\Models\Admin;

use Carbon\Carbon;
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

    public function getVip()
    {
        $now = Carbon::now();

        if ($this->subscription) {
            $inicio = Carbon::parse($this->subscription);

            if ($inicio->addMonth() < $now) {
                return false;
            } else {
                return $inicio->diffInDays($now);
            }
        } else {
            return false;
        }
    }
    
}
