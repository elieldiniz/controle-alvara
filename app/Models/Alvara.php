<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasOwner;

class Alvara extends Model
{
    use HasFactory, HasOwner;
    protected $fillable = [
        'empresa_id',
        'user_id',
        'owner_id',
        'tipo_alvara_id',
        'tipo',
        'numero',
        'data_emissao',
        'data_vencimento',
        'status',
        'observacoes',
    ];

    protected $casts = [
        'data_emissao' => 'datetime',
        'data_vencimento' => 'datetime',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function calendarEvents()
    {
        return $this->hasMany(CalendarEvent::class);
    }

    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class);
    }

    public function tipoAlvara()
    {
        return $this->belongsTo(TipoAlvara::class, 'tipo_alvara_id');
    }

    public function scopeVigente($query)
    {
        return $query->where('status', 'vigente');
    }

    public function scopeEmRenovacao($query)
    {
        return $query->where('status', 'proximo');
    }

    public function scopeVencido($query)
    {
        return $query->where('status', 'vencido');
    }
}
