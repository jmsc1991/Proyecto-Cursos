<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    public $table = 'videos';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'description',
        'url',
        'course_id',
        'free',
    ];

    protected $casts = [
        'title' => 'string',
        'url' => 'string',
        'description' => 'text',
        'course_id' => 'integer',
    ];

    public static $rules = [
        'title' => 'required',
        'url' => 'required',
        'description' => 'required',
        'course_id' => 'required',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
