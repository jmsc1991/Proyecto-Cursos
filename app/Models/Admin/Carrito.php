<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function getTotal()
    {
        $carrito = Carrito::where([['user_id', Auth::user()->id], ['estado', 'Pendiente']])->first();

        $total = 0;

        foreach ($carrito->cursos as $curso) {
            $total = $total + $curso->price;
        }

        return $total;
    }

}
