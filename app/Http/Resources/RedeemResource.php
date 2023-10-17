<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RedeemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'point' => $this->point,
            'title' => $this->title,
            'picture' => $this->picture,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'active' => $this->active,
            'createdAt' => $this->createdAt
        ];
    }
}
