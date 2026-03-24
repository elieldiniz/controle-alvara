<?php

namespace App\Traits;

use App\Models\Scopes\OwnerScope;

trait HasOwner
{
    public static function bootHasOwner()
    {
        static::addGlobalScope(new OwnerScope);

        static::creating(function ($model) {
            if (auth()->check()) {
                // Se o usuário logado for um membro, herda o owner_id do "pai" (owner)
                // Se for o próprio owner, usa o seu próprio ID
                $user = auth()->user();
                $model->owner_id = $user->owner_id ?: $user->id;
            }
        });
    }

    public function owner()
    {
        return $this->belongsTo(\App\Models\User::class, 'owner_id');
    }
}
