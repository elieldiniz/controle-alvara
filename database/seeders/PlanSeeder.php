<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Plan::updateOrCreate(['slug' => 'start'], [
            'nome' => 'Plano Start',
            'max_users' => 2,
            'features' => ['essential_features' => true],
        ]);

        \App\Models\Plan::updateOrCreate(['slug' => 'intermediario'], [
            'nome' => 'Plano Intermediário',
            'max_users' => 4,
            'features' => ['additional_features' => true],
        ]);
    }
}
