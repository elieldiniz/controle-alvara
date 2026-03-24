<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Empresa;
use App\Models\Alvara;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            PlanSeeder::class,
            TipoAlvaraSeeder::class,
        ]);

        // 1. Super Admin (SaaS Manager)
        $superAdmin = User::factory()->create([
            'name' => 'Super Administrador',
            'email' => 'admin@alvras.com',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole('super-admin');

        // 2. Client Owner (Account Holder)
        $owner = User::factory()->create([
            'name' => 'Eliel Diniz',
            'email' => 'eliel@alvras.com',
            'password' => Hash::make('password'),
            'plan_id' => \App\Models\Plan::where('nome', 'Plano Intermediário')->first()->id,
        ]);
        $owner->assignRole('owner');
        $owner->owner_id = $owner->id; // Ele mesmo é a raiz
        $owner->save();

        // 3. Team Member
        $member = User::factory()->create([
            'name' => 'Membro da Equipe',
            'email' => 'membro@alvras.com',
            'password' => Hash::make('password'),
            'parent_id' => $owner->id,
            'owner_id' => $owner->id,
            'plan_id' => $owner->plan_id,
        ]);
        $member->assignRole('member');

        // Criar Empresas para o owner
        $empresas = Empresa::factory()->count(3)->create([
            'user_id' => $owner->id,
            'owner_id' => $owner->id,
        ]);

        $tipoPadrao = \App\Models\TipoAlvara::first();

        // Para cada empresa criar alguns Alvarás
        foreach ($empresas as $empresa) {
            Alvara::factory()->count(rand(2, 5))->create([
                'empresa_id' => $empresa->id,
                'user_id' => $owner->id,
                'owner_id' => $owner->id,
                'tipo_alvara_id' => $tipoPadrao->id,
            ]);
            
            // Associar tipos à empresa (Pivot)
            $empresa->tiposAlvara()->attach(\App\Models\TipoAlvara::limit(2)->pluck('id'));
        }
        
        // Configurações de alerta default para o owner
        $owner->alertConfigs()->createMany([
            ['dias_antes' => 30, 'tipo' => 'sistema'],
            ['dias_antes' => 15, 'tipo' => 'email'],
            ['dias_antes' => 7, 'tipo' => 'whatsapp'],
        ]);
    }
}
