<?php

namespace App\Http\Resources;

use App\Model\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'icon'=>filePath($this->icon),
            'courses'=>Course::where('category_id',$this->id)->count(),
            'popular'=>$this->is_popular,
            'top'=>$this->top,
            'parent'=>$this->parent_category_id
        ];
    }
}
