<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $values = parent::toArray($request);
        $values['image_path'] = asset('storage/' . $this->image_path); 
        $values['created'] = $this->created_at->format('d-m-Y H:i:s');
        $values['updated'] = $this->updated_at->format('d-m-Y H:i:s');
        unset(
            $values['created_at'],
            $values['updated_at'],
            $values['deleted_at'],
        );
        return $values;
    }
}
