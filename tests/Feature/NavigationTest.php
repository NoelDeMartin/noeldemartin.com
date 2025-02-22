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
    $response->assertSee('The Curse of Being A Developer');
    $response->assertSee('I am a software developer, and many people I speak with tell me how lucky I am');
    $response->assertSee('Dec 3, 2014');
    $response->assertSee('Starting Something New');
    $response->assertSee('Nov 2014');
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
    $this->get('/projects')->assertStatus(200)->assertSee('Umai')->assertSee('Soukai')->assertSee('Geemba');
    $this->get('/projects/geemba')->assertStatus(200)->assertSee('We aimed to make fitness more accessible');
    $this->get('/projects/beastmasters')->assertStatus(200)->assertSee('an online turn-based card game');
});

test('Talks', function () {
    $response = $this->get('/talks');

    $response->assertStatus(200);
    $response->assertSee('Solid CRDTs in Practice');
    $response->assertSee('May 3, 2024');
    $response->assertSee('Solid Symposium');
    $response->assertSee('Leuven, Belgium');
    $response->assertSee('CRDTs is the technology that enables local-first applications');
    $response->assertSee('Video');
    $response->assertSee('(12 min)');
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
