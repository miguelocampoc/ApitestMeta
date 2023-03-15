<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KeywordResource;

class OrcidResource extends JsonResource
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
            'orcid_identifier_path' => $this->orcid_identifier_path,
            'given_names' => $this->given_names,
            'family_name' => $this->family_name,
            'email_primary' => $this->email_primary,
            'keywords'=> KeywordResource::collection($this->keywords),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
