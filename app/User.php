<?php

namespace App;

use App\Models\Admin\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles,Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
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
