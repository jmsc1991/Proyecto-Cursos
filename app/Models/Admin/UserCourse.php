<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $table = 'user_courses';

    protected $fillable = ['user_id', 'course_id'];
}
