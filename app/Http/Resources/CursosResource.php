<?php

namespace App\Http\Resources;

use App\Models\Admin\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CursosResource extends JsonResource
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
            'categoria' => Category::find($this->category_id)->name,
            'precio' => $this->price
        ];
    }
}
