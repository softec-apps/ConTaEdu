<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PlanCuentas  extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cuenta',
        'description',
        'tipocuenta',
        'signo',
        'tipoestado',
        'est',
        'template_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Relación con DetalleAsientoContable
    public function detallesAsiento()
    {
        return $this->hasMany(DetalleAsientoContable::class, 'cuenta_id');
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
