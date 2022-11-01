<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListGuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'noticket' => $this->noticket,
            'status' => $this->status,
            'tanggal' => $this->created_at,
            'nama' => $this->name,
            'nohp' => $this->nohp,
            'perihal' => $this->necessity,
            'serveBy' => $this->serveBy,
        ];
    }
}
