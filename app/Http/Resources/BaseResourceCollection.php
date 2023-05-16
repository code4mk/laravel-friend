<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
{
    /**
     * Customize the pagination information for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $paginated
     * @param  array  $default
     * @return array
     */
    public function paginationInformation($request, $paginated, $default)
    {
        $pagination = [
            'current_page' => $default['meta']['current_page'],
            'last_page' => $default['meta']['last_page'],
            'from' => $default['meta']['from'],
            'to' => $default['meta']['to'],
            'total' => $default['meta']['total'],
            'per_page' => $default['meta']['per_page'],
            'path' => $default['meta']['path'],
        ];

        return ['pagination' => $pagination];
    }
}
