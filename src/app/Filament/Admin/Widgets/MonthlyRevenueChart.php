<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class MonthlyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pemasukkan Bulanan';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // Ambil semua pembayaran lunas yang punya paid_at
        $payments = Payment::where('status', 'lunas')
            ->whereNotNull('paid_at')
            ->with('order')
            ->get();

        // Kelompokkan berdasarkan bulan dari paid_at
        $grouped = $payments->groupBy(function ($payment) {
            return Carbon::parse($payment->paid_at)->format('Y-m'); // contoh: 2025-07
        });

        // Format data
        $data = $grouped->mapWithKeys(function ($group, $month) {
            $total = $group->sum(fn ($payment) => $payment->order?->total ?? 0);
            $label = Carbon::createFromFormat('Y-m', $month)->translatedFormat('F Y'); // contoh: Juli 2025
            return [$label => (int) $total];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Total Pemasukkan (Lunas)',
                    'data' => $data->values(),
                    'backgroundColor' => '#F59E0B',
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
