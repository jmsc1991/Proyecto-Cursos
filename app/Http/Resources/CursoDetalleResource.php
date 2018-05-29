<?php

namespace App\Http\Resources;

use App\Models\Admin\Category;
use App\Models\Admin\Video;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CursoDetalleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'titulo' => $this->title,
            'extracto' => $this->excerpt,
            'descripcion' => $this->description,
            'precio' => $this->price,
            'categoria_id' => $this->category_id,
            'categoria' => Category::find($this->category_id)->name,
            'aprenderas' => $this->learn,
            'requisitos' => $this->requirements,
            'autor' => User::find($this->user_id)->name,
            'videos' => VideoDetalleResource::collection(Video::where('course_id', $this->id)->get())
        ];
    }
}
