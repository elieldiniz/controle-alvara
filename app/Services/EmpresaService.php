<?php

namespace App\Services;

use App\Models\Empresa;
use App\DTOs\EmpresaDTO;

class EmpresaService
{
    public function criar(EmpresaDTO $dto): Empresa
    {
        $empresa = Empresa::create($dto->toArray());
        
        if (!empty($dto->tipos_alvara)) {
            $empresa->tiposAlvara()->sync($dto->tipos_alvara);
        }
        
        return $empresa;
    }

    public function atualizar(Empresa $empresa, EmpresaDTO $dto): Empresa
    {
        $empresa->update($dto->toArray());
        $empresa->tiposAlvara()->sync($dto->tipos_alvara);
        return $empresa;
    }

    public function excluir(Empresa $empresa): void
    {
        $empresa->delete();
    }
}
