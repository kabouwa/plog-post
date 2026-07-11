<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $values = parent::toArray($request);
        unset($values['deleted_at']);
        $values['email_verified_at'] = $this->email_verified_at ? $this->email_verified_at->format('d-m-Y H:i:s') : null;
        $values['created_at'] = $this->created_at->format('d-m-Y H:i:s');
        $values['updated_at'] = $this->updated_at->format('d-m-Y H:i:s');
        return $values;
    }
}
