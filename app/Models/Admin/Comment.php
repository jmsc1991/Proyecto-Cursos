<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public $table = 'comments';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'content',
        'video_id',
        'user_id',
        'parent_id',
    ];

    protected $casts = [
      'content' => 'text',
      'video_id' => 'integer',
      'user_id' => 'integer',
      'parent_id' => 'integer',
    ];

    public static $rules = [
        'content' => 'required',
        'video_id' => 'required',
        'user_id' => 'required',
        'parent_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function parentComment()
    {
        return $this->hasOne('comment','parent_id');
    }

    public function comments()
    {
        return $this->hasMany('comment','parent_id');
    }
}
