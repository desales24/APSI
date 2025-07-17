<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Shoe;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ShoeCountChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Sepatu per Hari (Minggu Ini)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek(); // Senin
        $endOfWeek = Carbon::now()->endOfWeek();     // Minggu

        // Buat array jumlah sepatu per hari (Senin - Minggu)
        $dailyCounts = collect();
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $count = Shoe::whereDate('created_at', $date)->count();
            $dailyCounts->put($date->locale('id')->translatedFormat('l'), $count); // nama hari dalam Bahasa Indonesia
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Sepatu',
                    'data' => $dailyCounts->values(),
                    'backgroundColor' => '#10B981', // warna hijau
                ],
            ],
            'labels' => $dailyCounts->keys(), // nama hari
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // atau 'line' jika ingin garis tren
    }
}
