<?php

namespace App\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    private $data = [
        'type' => 'DataNotFoundException',
        'code' => 404,
    ];

    public function __construct($data = [])
    {
        $this->data = [
            ...$this->data,
            ...$data,
        ];
    }

    public function render($request)
    {
        $this->data = [
            ...$this->data,
            'path' => $request->path(),
        ];

        return response()->json($this->data, 404);
    }
}
