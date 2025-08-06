<?php
namespace App\Utils;

use Illuminate\Support\Facades\Http;
use DateInterval;
use DateTime;
use Exception;

function extractYoutubeId(string $url): ?string {
    if (preg_match('/(?:youtu\.be\/|v=)([A-Za-z0-9_-]+)/', $url, $m)) {
        return $m[1];
    }
    return null;
}

function getYoutubeDuration(string $videoId): ?string {
    $response = Http::get('https://www.googleapis.com/youtube/v3/videos', [
        'id'   => $videoId,
        'part' => 'contentDetails',
        'key'  => config('services.youtube.key'),
    ]);

    $iso = $response->json('items.0.contentDetails.duration');
    return $iso ? formatIsoDuration($iso) : null;
}

function formatIsoDuration(string $iso): string {
    try {
        $duration = new DateInterval($iso);
        $start = new DateTime('@0');
        $start->add($duration);
        return $start->format(strlen($iso) > 6 ? 'H:i:s' : 'i:s');
    } catch (Exception $e) {
        return '';
    }
}

?>
