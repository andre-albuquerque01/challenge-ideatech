<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprovacoes extends Model
{
    use HasFactory;

    protected $table = 'aprovacoes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'processo_id',
        'signatario_id',
        'status',
        'justificativa',
        'data_aprovacao',
    ];

    protected $casts = [
        'data_aprovacao' => 'datetime',
    ];


    public function processo()
    {
        return $this->belongsTo(Processos::class, 'processo_id', 'id');
    }

    public function signatario()
    {
        return $this->belongsTo(Signatarios::class, 'signatario_id', 'id');
    }
}
