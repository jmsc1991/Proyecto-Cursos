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
        'url',
    ];

    protected $casts = [
        'url' => 'string',
    ];

    public static $rules = [
        'url' => 'required',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function course()
    {
        return $this->belogsTo(Course::class);
    }
}
