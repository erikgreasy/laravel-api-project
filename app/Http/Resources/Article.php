<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'body'  => $this->body,
        ];
    }


    /**
     * This gets send with every request
     */
    public function with( $request ) {
        return [
            'version'   => '1.0.0',
            'author_url'    => url( 'https://www.greasydesign.sk' ),
        ];
    }
}
