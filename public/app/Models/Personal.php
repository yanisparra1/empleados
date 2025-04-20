<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personal extends Model
{
    protected $fillable = ['nombre', 'apellido','cedula', 'fecha_ingreso', 'tipo_personal_id'];

    public function tipoPersonal(): BelongsTo
    {
        return $this->belongsTo(TipoPersonal::class);
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class);
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(Asistencia::class);
    }
}
