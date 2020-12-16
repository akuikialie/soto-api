<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date_at' => (new \DateTime($this->date_at))->format('F m Y'),
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'journal' => new JournalResource($this->whenLoaded('journal')),
            'vendor' => new VendorResource($this->whenLoaded('vendor')),
        ];
        // return parent::toArray($request);
    }
}
