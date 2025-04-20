<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;

class Personal extends Model
{
    protected $fillable = ['image',
    'nombre', 'apellido','cedula','qr', 'fecha_ingreso', 'tipo_personal_id'];

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
        return $this->hasMany(Asistencia::class, 'cedula', 'cedula');
    }


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($personal) {
            if ($personal->cedula) {
                $personal->qr = Crypt::encrypt($personal->cedula);
            }
        });

        static::updating(function ($personal) {
            if ($personal->cedula) {
                $personal->qr = Crypt::encrypt($personal->cedula);
            }
        });
    }
}
