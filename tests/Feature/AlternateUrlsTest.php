<?php

use App\Support\Facades\AlternateUrls;
use Illuminate\Support\Facades\Blade;

test('Tracks alternate URLs', function () {
    AlternateUrls::clear();

    expect(AlternateUrls::all())->toBeEmpty();
    expect(AlternateUrls::has('https://example.com/test.md'))->toBeFalse();

    AlternateUrls::markdown('https://example.com/test.md');

    expect(AlternateUrls::has('https://example.com/test.md'))->toBeTrue();
    expect(AlternateUrls::all())->toHaveCount(1);
    expect(AlternateUrls::all()[0])->toEqual([
        'url' => 'https://example.com/test.md',
        'type' => 'text/markdown',
        'title' => null,
    ]);

    expect(AlternateUrls::render())->toBe('<link rel="alternate" type="text/markdown" href="https://example.com/test.md" />');
});

test('Renders via blade directive', function () {
    AlternateUrls::clear();
    AlternateUrls::add('https://example.com/feed.atom', 'application/atom+xml', 'Atom Feed');

    $html = Blade::render('@alternateUrls');

    expect($html)->toBe('<link rel="alternate" type="application/atom+xml" title="Atom Feed" href="https://example.com/feed.atom" />');
});

test('Renders empty string when no alternate URLs are registered', function () {
    AlternateUrls::clear();

    expect(AlternateUrls::render())->toBe('');
    expect(Blade::render('@alternateUrls'))->toBe('');
});
