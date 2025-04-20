<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asistencia extends Model
{
    protected $fillable = ['personal_id', 'fecha', 'hora_entrada', 'hora_salida', 'estado'];

    public function personal(): BelongsTo
    {
        return $this->belongsTo(Personal::class);
    }

    public function registrosAsistencia()
    {
        return $this->hasMany(RegistroAsistencia::class);
    }
}
