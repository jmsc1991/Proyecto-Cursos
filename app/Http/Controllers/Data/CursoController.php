<?php

namespace App\Http\Controllers\Data;

use App\Http\Resources\CursoDetalleResource;
use App\Http\Resources\CursosResource;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CursoController extends Controller
{
    public function getAllCursos()
    {
        $cursos = Course::paginate(6);

        if ($cursos) {
            return CursoDetalleResource::collection($cursos);
        }
    }

    public function getTopCursos()
    {
        $cursos = Course::all()->take(6);

        if ($cursos) {
            return CursosResource::collection($cursos);
        }
    }

    public function verCurso($id)
    {
        $curso = Course::where('id', $id)->first();

        if ($curso) {
            return new CursoDetalleResource($curso);
        }
    }
}
