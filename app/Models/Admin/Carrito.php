<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';

    protected $fillable = ['user_id', 'estado'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Course::class, 'carrito_cursos');
    }

}
