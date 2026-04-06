<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\LaravelMail\Services\MailStats;

class MailStatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $stats = app(MailStats::class);
        $days = (int) ($this->filters['period'] ?? 7);
        $from = Carbon::now()->subDays($days);
        $to = Carbon::now();

        $sent = $stats->sent($from, $to);
        $delivered = $stats->delivered($from, $to);
        $bounced = $stats->bounced($from, $to);
        $opened = $stats->opened($from, $to);
        $deliveryRate = $stats->deliveryRate($from, $to);
        $bounceRate = $stats->bounceRate($from, $to);

        return [
            Stat::make('Emails Sent', number_format($sent))
                ->description("Last {$days} days")
                ->descriptionIcon('heroicon-o-paper-airplane')
                ->color('primary'),

            Stat::make('Delivered', number_format($delivered))
                ->description(number_format($deliveryRate, 1).'% delivery rate')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Bounced', number_format($bounced))
                ->description(number_format($bounceRate, 1).'% bounce rate')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Opened', number_format($opened))
                ->description("Last {$days} days")
                ->descriptionIcon('heroicon-o-envelope-open')
                ->color('info'),
        ];
    }
}
