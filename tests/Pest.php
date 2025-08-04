<?php

use Illuminate\Testing\TestResponse;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

uses(TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

//

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function assertSeeIn(TestResponse $response, string $selector, string $expected): void
{
    $dom = new DOMDocument();
    $converter = new CssSelectorConverter();

    libxml_use_internal_errors(true);
    $dom->loadHTML($response->getContent());
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $elements = $xpath->query($converter->toXPath($selector));

    expect($elements->item(0)->textContent)->toContain($expected);
}

/*
|--------------------------------------------------------------------------
| Architecture
|--------------------------------------------------------------------------
|
| Architecture testing enables you to specify expectations that test whether your application
| adheres to a set of architectural rules, helping maintain a clean and sustainable codebase.
| The expectations are determined by different types of namespaces or function names.
|
*/

arch()->preset()->laravel();
arch()
    ->expect('App')
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump']);
