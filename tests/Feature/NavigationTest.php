<?php

test('Home', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Hi there!');
    $response->assertSee('hey@noeldemartin.com');
    $response->assertSee('My Youtube channel');
    $response->assertSee('https://youtube.com/@noeldemartin');
});

test('Blog', function () {
    $response = $this->get('/blog');

    $response->assertStatus(200);
    $response->assertSee('Starting Something New');
    $response->assertSee('Nov 10, 2014');
});

test('Blog post', function () {
    $response = $this->get('/blog/starting-something-new');

    $response->assertStatus(200);
    $response->assertSee('Starting Something New');
    $response->assertSee('Nov 10, 2014');
    $response->assertSee('3 min.');
    $response->assertSee('There is a feeling I enjoy a lot. The feeling of Starting Something New.');
    $response->assertSee('What this blog will be about');
});

test('Projects', function () {
    $response = $this->get('/projects');

    $response->assertStatus(200);
    $response->assertSee('Umai');
    $response->assertSee('Soukai');
    $response->assertSee('Geemba');

    $this->get('/projects/geemba')->assertSee('We aimed to make fitness more accessible');
    $this->get('/projects/beastmasters')->assertSee('an online turn-based card game');
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

test('Tasks', function () {
    $response = $this->get('/tasks');

    $response->assertStatus(200);
    $response->assertSee('All Tasks');
    $response->assertSee('Reading Musashi by Eiji Yoshikawa');
    $response->assertSee('Housekeeping 2024/25');
});

test('Task comments', function () {
    $response = $this->get('/tasks/reading-musashi-by-eiji-yoshikawa');

    $response->assertStatus(200);
    $response->assertSee('Reading Musashi by Eiji Yoshikawa');
    $response->assertSee('Task started');
    $response->assertSee('Well, it is time');
    $response->assertSee('After looking over my notes');
    $response->assertSee('Task completed');
});
