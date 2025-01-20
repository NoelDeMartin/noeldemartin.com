<?php

test('Sitemap', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertStatus(200);
    $response->assertSee('/blog');
    $response->assertSee('/projects/geemba');
    $response->assertSee('/tasks/reading-musashi-by-eiji-yoshikawa');
});
