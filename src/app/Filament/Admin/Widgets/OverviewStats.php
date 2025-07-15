<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use App\Models\Shoe;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class OverviewStats extends BaseWidget
{
    protected function getCards(): array
    {
        $totalRevenue = Order::sum('total');

        return [
            Card::make('Jumlah Pelanggan', User::count())
                ->icon('heroicon-o-users')
                ->color('info'),

            Card::make('Jumlah Sepatu', Shoe::count())
                ->icon('heroicon-o-cube')
                ->color('success'),

            Card::make('Total Pemasukkan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->icon('heroicon-o-currency-dollar')
                ->color('primary'),
        ];
    }
}
