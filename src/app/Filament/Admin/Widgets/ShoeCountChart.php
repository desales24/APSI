<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Shoe;
use App\Models\CategoryShoe;
use Filament\Widgets\ChartWidget;

class ShoeCountChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Sepatu per Kategori';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = CategoryShoe::withCount('shoes')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Sepatu',
                    'data' => $data->pluck('shoes_count')->map(fn ($v) => (int) $v),
                ],
            ],
            'labels' => $data->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // diagram batang
    }
}
