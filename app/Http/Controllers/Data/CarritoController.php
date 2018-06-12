<?php

namespace App\Http\Controllers\Data;

use App\Http\Resources\CarritoResource;
use App\Models\Admin\Carrito;
use App\Models\Admin\CarritoCurso;
use App\Models\Admin\UserCourse;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function getCarrito()
    {
        $carrito = Carrito::where([
            ['user_id', Auth::user()->id],
            ['estado', 'Pendiente']
        ])->first();

        if ($carrito) {
            return new CarritoResource($carrito);
        }

        $carrito = Carrito::create([
            'user_id' => Auth::user()->id,
            'estado' => 'Pendiente'
        ]);

        return new CarritoResource($carrito);
    }

    public function add($id)
    {
        $item = CarritoCurso::where([
            ['carrito_id', Carrito::where([['user_id', Auth::user()->id], ['estado', 'Pendiente']])->first()->id],
            ['course_id', $id],
        ])->first();

        if ($item) {
            return response()->json('repetido');
        }

        $item = CarritoCurso::create([
            'carrito_id' => Carrito::where([['user_id', Auth::user()->id], ['estado', 'Pendiente']])->first()->id,
            'course_id' => $id,
        ]);

        if ($item) {
            return response()->json('ok');
        }
    }

    public function remove($id)
    {
        $carrito = Carrito::where([['user_id', Auth::user()->id], ['estado', 'Pendiente']])->first();

        $item = CarritoCurso::where([
            ['carrito_id', $carrito->id],
            ['course_id', $id]
            ]);

        $item->delete();
    }

    public function comprar()
    {
        $carrito = Carrito::where([['user_id', Auth::user()->id], ['estado', 'Pendiente']])->first();

        foreach ($carrito->cursos as $curso) {
            UserCourse::create([
                'user_id' => Auth::user()->id,
                'course_id' => $curso->id,
            ]);
        }

        $carrito->estado = 'Finalizado';
        $carrito->save();

    }

    public function comprarVip()
    {
        $user = User::find(Auth::user()->id);

        $now = Carbon::now();

        $user->subscription = $now->toDateString();

        $user->update();
    }
}
