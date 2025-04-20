<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class TipoPersonal extends Model
{
    protected $fillable = ['descripcion'];

    public function personal(): HasMany
    {
        return $this->hasMany(Personal::class);
    }
}
