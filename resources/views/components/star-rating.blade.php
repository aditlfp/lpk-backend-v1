{{-- resources/views/components/star-rating.blade.php --}}
@props(['rating'])

@php
    $max = 5;
    $rating = (float) $rating;
    $rating = max(0, min($rating, $max));
    $rounded = round($rating * 2) / 2;

    $full = (int) floor($rounded);
    $half = ($rounded - $full) >= 0.5 ? 1 : 0;
    $empty = $max - $full - $half;

    $size = 'w-4 h-4'; // Slightly smaller for table cells
    $starPath = 'M10.868 2.884c.321-.772 1.308-.772 1.629 0l1.983 4.795a1 1 0 00.753.542h5.036c.84 0 1.18.993.524 1.485l-4.073 2.96a1 1 0 00-.364 1.118l1.518 4.674c.274.84-.658 1.558-1.413 1.053l-4.24-3.083a1 1 0 00-1.175 0l-4.24 3.083c-.755.505-1.687-.213-1.413-1.053l1.518-4.674a1 1 0 00-.364-1.118L2.554 9.706c-.655-.492-.316-1.485.524-1.485h5.036a1 1 0 00.753-.542l1.983-4.795z';

    // Using a unique ID for the gradient to prevent conflicts
    $gradId = 'grad_' . uniqid();
@endphp

<div class="flex items-center space-x-1 py-1">
    {{-- Full Stars --}}
    @for ($i = 0; $i < $full; $i++)
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="{{ $size }}" fill="#facc15">
            <path fill-rule="evenodd" d="{{ $starPath }}" clip-rule="evenodd" />
        </svg>
    @endfor

    {{-- Half Star --}}
    @if ($half)
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="{{ $size }}">
            <defs>
                <linearGradient id="{{ $gradId }}">
                    <stop offset="50%" stop-color="#facc15" />
                    <stop offset="50%" stop-color="#d1d5db" />
                </linearGradient>
            </defs>
            <path fill="url(#{{ $gradId }})" d="{{ $starPath }}" />
        </svg>
    @endif

    {{-- Empty Stars --}}
    @for ($i = 0; $i < $empty; $i++)
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="{{ $size }}" fill="#d1d5db">
            <path fill-rule="evenodd" d="{{ $starPath }}" clip-rule="evenodd" />
        </svg>
    @endfor

    {{-- Numeric Rating --}}
    <span class="ml-2 text-xs text-gray-500">({{ number_format($rating, 1) }})</span>
</div>

<?php
