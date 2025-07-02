<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatarios extends Model
{
    use HasFactory;

    protected $table = 'signatarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'email',
        'cargo',
    ];

    public function aprovacoes()
    {
        return $this->hasMany(Aprovacoes::class, 'signatario_id');
    }
}
