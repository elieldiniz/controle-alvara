<?php

namespace App\Filament\Widgets;

use App\Models\Alvara;
use App\Models\Empresa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Empresas', Empresa::count())
                ->description('Empresas cadastradas')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info'),
            Stat::make('Alvarás Vigentes', Alvara::where('status', 'vigente')->count())
                ->description('Status: OK')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Vencendo em Breve', Alvara::where('status', 'proximo')->count())
                ->description('Atenção necessária')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),
            Stat::make('Alvarás Vencidos', Alvara::where('status', 'vencido')->count())
                ->description('Ação imediata')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
