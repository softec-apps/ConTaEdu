<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{

    use HasFactory;

    protected $fillable = ['id', 'name', 'description'];

    public function planCuentas()
    {
        return $this->hasMany(PlanCuentas::class);
    }
}
