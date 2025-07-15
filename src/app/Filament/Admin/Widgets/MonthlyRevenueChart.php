<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class MonthlyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pemasukkan Bulanan';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = Order::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Pemasukkan',
                    'data' => $data->pluck('total')->map(fn ($v) => (int) $v), // hilangkan desimal
                ],
            ],
            'labels' => $data->pluck('month'),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // diagram batang
    }
}
