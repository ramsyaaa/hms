<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoticeboardResource extends JsonResource
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
            'first_name' => $this->title,
            'last_name' => $this->created_at,
        ];
//        return parent::toArray($request);
    }
}
