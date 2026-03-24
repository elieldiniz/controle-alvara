<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OwnerScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            // Super-admin pode ver tudo
            if ($user->hasRole('super-admin')) {
                return;
            }

            // Filtra pelo owner_id do usuário (ou seu próprio ID se ele for o owner)
            $ownerId = $user->owner_id ?: $user->id;
            $builder->where($model->getTable() . '.owner_id', $ownerId);
        }
    }
}
