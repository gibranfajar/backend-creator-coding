<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobForYouResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'requirement' => $this->requirement,
            'description' => $this->description,
            'opportunity' => new OpportunityResource($this->opportunity),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
