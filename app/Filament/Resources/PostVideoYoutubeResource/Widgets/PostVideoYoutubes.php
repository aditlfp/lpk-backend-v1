<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\PostVideoYoutube;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class PostVideoYoutubes extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'postVideoYoutubes';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Monthly Post Video Counts';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */

    // Loading ......
    protected static bool $deferLoading = true;
    protected function getOptions(): array
    {
        if (! $this->readyToLoad) {
            return [];
        }
        $data = Trend::model(PostVideoYoutube::class)
            ->between(
                start: now()->subYear()->startOfYear(),
                end: now()->endOfYear()
            )
            ->perMonth()
            ->count();

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => $data->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M'))->toArray(),
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
