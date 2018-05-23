<?php

namespace App\Http\Controllers\Data;

use App\Http\Resources\CategoriaResource;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{
    public function getCategorias()
    {
        $categorias = Category::all();

        if ($categorias) {
            return CategoriaResource::collection($categorias);
        }
    }
}
