<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\User;
use Flowframe\Trend\Trend;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;

class UsersChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'usersChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Users Registered';

    // Loading ......
    protected static bool $deferLoading = true;


    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        if (! $this->readyToLoad) {
            return [];
        }

        $data = Trend::model(User::class)
            ->between(start: now()->subMonth(), end: now())
            ->perDay()
            ->count();

        return [
            'chart' => [
                'type'   => 'line',
                'height' => 300,
            ],
            'series' => [[
                'name' => 'Users',
                'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
            ]],
            'xaxis' => [
                'categories' => $data->map(fn(TrendValue $value) => $value->date),
            ],
            'stroke' => ['curve' => 'smooth'],
            'colors' => ['#4f46e5'], // customize as you like
        ];
    }
}
