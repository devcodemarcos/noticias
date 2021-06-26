<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'author' => $this->author,
            'title' => $this->title,
            'description' => $this->description,
            'urlToImage' => $this->urlToImage,
            'publishedAt' => $this->publishedAt
        ];
    }
}
