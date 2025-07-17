<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class WeeklyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pemasukkan per Minggu (4 Minggu Terakhir)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $weeks = collect();

        // Mulai dari minggu 3 minggu lalu hingga minggu ini (total 4 minggu)
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            $label = $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M');

            $total = Payment::whereBetween('paid_at', [$startOfWeek, $endOfWeek])
                ->where('status', 'lunas')
                ->with('order')
                ->get()
                ->sum(function ($payment) {
                    return $payment->order?->total ?? 0;
                });

            $weeks->put($label, (int) $total);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukkan per Minggu (Lunas)',
                    'data' => $weeks->values(),
                    'backgroundColor' => '#6366F1',
                ],
            ],
            'labels' => $weeks->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
