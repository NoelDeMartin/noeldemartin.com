<?php

test('Home', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Hi there!');
    $response->assertSee('hey@noeldemartin.com');
});

test('Blog', function () {
    $response = $this->get('/blog');

    $response->assertStatus(200);
    $response->assertSee('Starting Something New');
    $response->assertSee('Nov 10, 2014');
});

test('Projects', function () {
    $response = $this->get('/projects');

    $response->assertStatus(200);
    $response->assertSee('Umai');
    $response->assertSee('Soukai');
    $response->assertSee('Geemba');
});

test('Now', function () {
    $response = $this->get('/now');

    $response->assertStatus(200);
    $response->assertSee('Last updated');
    $response->assertSee('2014');
    $response->assertSee('Published');
    $response->assertSee('Started');
    $response->assertSee('Commented');
    $response->assertSee('Completed');
    $response->assertSee('Starting Something New');
    $response->assertSee('Reading Musashi by Eiji Yoshikawa');
});
