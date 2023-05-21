<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'publication_date' => $this->publication_date,
            'price' => $this->price,
            'description' => $this->description,
            'author' => new AuthorResource($this->whenLoaded('author'))
        ];
    }
}
