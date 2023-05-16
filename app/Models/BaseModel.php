<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    /**
     * Check if a column exists.
     *
     * @param  string  $columnName - Column name.
     * @return bool
     */
    public function checkIfColumnExists($columnName): bool
    {
        return Schema::hasColumn($this->getTable(), $columnName);
    }
}
