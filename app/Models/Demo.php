<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Demo extends BaseModel
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'demos';
}
