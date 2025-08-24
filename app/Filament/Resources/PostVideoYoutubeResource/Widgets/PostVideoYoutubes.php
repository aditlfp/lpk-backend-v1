<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\PostVideoYoutube;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class PostVideoYoutubes extends ApexChartWidget
{
    protected static ?string $chartId = 'postVideoYoutubes';

    protected static ?string $heading = 'Monthly Post Video Counts';

    protected static bool $deferLoading = true;

    protected function getOptions(): array
    {
        if (! $this->readyToLoad) {
            return [];
        }

        // 🔹 Cache hasil query ke Redis selama 10 menit
        $data = Cache::remember('post_video_youtube_trend', now()->addMinutes(10), function () {
            return Trend::model(PostVideoYoutube::class)
                ->between(
                    start: now()->subYear()->startOfYear(),
                    end: now()->endOfYear()
                )
                ->perMonth()
                ->count();
        });

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => collect($data)->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
            'labels' => collect($data)->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M'))->toArray(),
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
