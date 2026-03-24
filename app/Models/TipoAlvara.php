<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAlvara extends Model
{
    protected $fillable = ['nome', 'slug', 'descricao'];

    public function alvaras()
    {
        return $this->hasMany(Alvara::class, 'tipo_alvara_id');
    }

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'empresa_tipo_alvara');
    }
}
