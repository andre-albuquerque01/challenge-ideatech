<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Processos extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'processos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['titulo', 'descricao', 'status'])
            ->logOnlyDirty()
            ->useLogName('processo')
            ->setDescriptionForEvent(fn(string $eventName) => "Processo {$eventName}");
    }

    public function documentos()
    {
        return $this->hasMany(Documentos::class, 'processo_id');
    }

    public function aprovacoes()
    {
        return $this->hasMany(Aprovacoes::class, 'processo_id');
    }
}
