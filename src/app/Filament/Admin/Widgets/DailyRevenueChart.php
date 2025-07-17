<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class DailyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pemasukkan Per Hari (7 Hari Terakhir)';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $data = collect();

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $formattedDate = $date->format('Y-m-d');

            $total = Payment::whereDate('paid_at', $date)
                ->where('status', 'lunas')
                ->with('order') // pastikan relasi order dimuat
                ->get()
                ->sum(function ($payment) {
                    return $payment->order?->total ?? 0;
                });

            $data->put($formattedDate, (int) $total);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Pemasukkan (Lunas)',
                    'data' => $data->values(),
                    'backgroundColor' => '#10B981',
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
