<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    /* public function toArray($request)
    {
        return parent::toArray($request);
    } */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'petugas' => $this->user_id,
            'email_cust' => $this->email_cust,
            'star' => $this->star,
            'tip' => $this->coin_tip,
            'comment' => $this->comment,
            'updated_at' => $this->updated_at,
        ];
    }
}
