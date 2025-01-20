<?php

test('Sitemap', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertStatus(200);
    $response->assertSee('/blog');
    $response->assertSee('/projects/geemba');
    $response->assertSee('/tasks/reading-musashi-by-eiji-yoshikawa');
});

test('Blog RSS', function () {
    $response = $this->get('/blog/rss.xml');

    $response->assertStatus(200);
    $response->assertSee('<feed xmlns="http://www.w3.org/2005/Atom">', false);
    $response->assertSee('Starting Something New');
});

test('Now RSS', function () {
    $response = $this->get('/now/rss.xml');

    $response->assertStatus(200);
    $response->assertSee('<feed xmlns="http://www.w3.org/2005/Atom">', false);
    $response->assertSee('Starting Something New');
    $response->assertSee('2014');
    $response->assertSee('Published');
    $response->assertSee('Started');
    $response->assertSee('Commented');
    $response->assertSee('Completed');
    $response->assertSee('Starting Something New');
    $response->assertSee('Reading Musashi by Eiji Yoshikawa');
});

test('Health', function () {
    $response = $this->get('/health');

    $response->assertStatus(200);
    $response->assertSee('Everything is OK');
});

test('Podcast feed', function () {
    $response = $this->get('/podcast/feed.xml');

    $response->assertStatus(200);
    $response->assertSee('Umai Development Journal');
});
