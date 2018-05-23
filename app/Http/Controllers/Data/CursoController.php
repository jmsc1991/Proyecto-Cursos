<?php

namespace App\Http\Controllers\Data;

use App\Http\Resources\CursosResource;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CursoController extends Controller
{
    public function getTopCursos()
    {
        $cursos = Course::all()->take(6);

        if ($cursos) {
            return CursosResource::collection($cursos);
        }
    }
}
