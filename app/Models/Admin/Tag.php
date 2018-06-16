<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    public $table = 'tags';

    protected $dates = ['deleted_at'];

    public $fillable = [
      'name',
      'description',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
    ];

    public static $rules = [
      'name' => 'required',
      'description' => 'required'
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }
}
