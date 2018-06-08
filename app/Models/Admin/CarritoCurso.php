<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CarritoCurso extends Model
{
    protected $table = 'carrito_cursos';

    protected $fillable = ['carrito_id', 'course_id'];

    public function cursos()
    {
        return $this->belongsTo(Course::class);
    }
}
