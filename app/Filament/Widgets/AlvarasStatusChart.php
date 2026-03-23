<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class AlvarasStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $vigente = \App\Models\Alvara::where('status', 'vigente')->count();
        $proximo = \App\Models\Alvara::where('status', 'proximo')->count();
        $vencido = \App\Models\Alvara::where('status', 'vencido')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Status dos Alvarás',
                    'data' => [$vigente, $proximo, $vencido],
                    'backgroundColor' => [
                        '#22c55e', // success
                        '#f59e0b', // warning
                        '#ef4444', // danger
                    ],
                ],
            ],
            'labels' => ['Vigente', 'Próximo ao Vencimento', 'Vencido'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
