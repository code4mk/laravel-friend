<?php

namespace App\Http\Resources\Demo;

use Illuminate\Http\Resources\Json\JsonResource;

class DemoResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'demo';

    /**
     * Transform the resource into array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            ...$this->resource->getAttributes(),
            //'relational_data' => $this->whenLoaded('relation')
        ];

        //   $outputData = [
        //     'id' => $this->id,
        //     'title' => $this->title,
        //     'description' => $this->description
        //   ];

        //  return $outputData;
    }
}
