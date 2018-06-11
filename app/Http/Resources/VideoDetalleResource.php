<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoDetalleResource extends JsonResource
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
            'descripcion' => $this->description,
            'url' => $this->url,
            'comentarios' => ComentarioDetalleResource::collection($this->comments),
            'free' => $this->free,
        ];
    }
}
