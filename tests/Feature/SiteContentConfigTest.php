<?php

test('site content config exposes owner editable homepage media paths', function () {
    $content = config('site-content');

    expect($content)
        ->toHaveKeys(['hero', 'promotions', 'ebooks', 'downloads', 'branches'])
        ->and($content['hero']['logo'])->toBe('content/hero/sakofah-hero-logo.png')
        ->and($content['hero']['slides'])->toHaveCount(12)
        ->and($content['hero']['slides'][0]['src'])->toBe('content/hero/krabi.jpg')
        ->and($content['promotions'][0]['slide_image'])->toBe('content/banners/69-01-36.jpg')
        ->and($content['ebooks'][0]['cover'])->toStartWith('content/ebooks/')
        ->and($content['downloads']['reports'][0]['path'])->toStartWith('content/reports/')
        ->and($content['downloads']['forms'][0]['path'])->toStartWith('content/forms/')
        ->and($content['branches'][0]['image'])->toStartWith('content/branches/');
});

test('homepage owner editable sections render from site content config', function () {
    $html = view('welcome', [
        'information' => collect(),
        'welfare' => collect(),
        'credit' => collect(),
        'foundation' => collect(),
    ])->render();

    expect($html)
        ->toContain('content/hero/sakofah-hero-logo.png')
        ->toContain('content/hero/krabi.jpg')
        ->toContain('content/banners/69-01-36.jpg')
        ->toContain('content/ebooks/annual-report-2568-kmre.jpg')
        ->toContain('content/branches/khlong_yang.jpg');
});

