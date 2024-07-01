<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'ejercicios';

    protected $fillable = [
        'titulo',
        'desc',
        'docente_id',
        'access_code',
    ];


    public static function getAllExercises()
    {
        return self::orderBy('created_at', 'desc')->get();
    }

    public static function getExerciseById($id)
    {
        return self::findOrFail($id);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}
