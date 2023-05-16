<?php

namespace App\Http\Resources\Demo;

use App\Http\Resources\BaseResourceCollection;

class DemoCollection extends BaseResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'demos';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [self::$wrap => $this->collection];
    }
}
