<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'estudiante_id',
        'ejercicio_id',
        'grade',
        'viewed',
        'sent',
    ];
}
