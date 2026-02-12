<?php

test('Home', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('hey@noeldemartin.com');
    $response->assertSee('My Youtube channel');
    $response->assertSee('https://youtube.com/@noeldemartin');
    assertSeeIn($response, 'main', 'Hi there!');
});

test('Blog', function () {
    $response = $this->get('/blog');

    $response->assertStatus(200);
    assertSeeIn($response, 'main', 'The Curse of Being A Developer');
    assertSeeIn($response, 'main', 'I am a software developer, and many people I speak with tell me how lucky I am');
    assertSeeIn($response, 'main', 'Dec 3, 2014');
    assertSeeIn($response, 'main', 'Starting Something New');
    assertSeeIn($response, 'main', 'Nov 2014');
});

test('Blog post', function () {
    $response = $this->get('/blog/starting-something-new');

    $response->assertStatus(200);
    assertSeeIn($response, 'article', 'Starting Something New');
    assertSeeIn($response, 'article', 'Nov 10, 2014');
    assertSeeIn($response, 'article', '3 min.');
    assertSeeIn($response, 'article', 'There is a feeling I enjoy a lot. The feeling of Starting Something New.');
    assertSeeIn($response, 'article', 'What this blog will be about');
});

test('Projects', function () {
    $this->get('/projects')->assertStatus(200)->assertSee('Umai')->assertSee('Soukai')->assertSee('Geemba');
    $this->get('/projects/geemba')->assertStatus(200)->assertSee('We aimed to make fitness more accessible');
    $this->get('/projects/beastmasters')->assertStatus(200)->assertSee('an online turn-based card game');
});

test('Talks', function () {
    $response = $this->get('/talks');

    $response->assertStatus(200);
    assertSeeIn($response, 'main', 'Solid CRDTs in Practice');
    assertSeeIn($response, 'main', 'May 3, 2024');
    assertSeeIn($response, 'main', 'Solid Symposium');
    assertSeeIn($response, 'main', 'Leuven, Belgium');
    assertSeeIn($response, 'main', 'CRDTs is the technology that enables local-first applications');
    assertSeeIn($response, 'main', 'Video');
    assertSeeIn($response, 'main', '(12 min)');
});

test('Slides', function () {
    $response = $this->get('/slides/interoperable-serendipity');

    $response->assertStatus(200);
    $response->assertSee('Interoperable Serendipity');
});

test('Now', function () {
    $response = $this->get('/now');

    $response->assertStatus(200);
    assertSeeIn($response, 'main', 'Last updated');
    assertSeeIn($response, 'main', '2014');
    assertSeeIn($response, 'main', 'Published');
    assertSeeIn($response, 'main', 'Started');
    assertSeeIn($response, 'main', 'Commented');
    assertSeeIn($response, 'main', 'Completed');
    assertSeeIn($response, 'main', 'Starting Something New');
    assertSeeIn($response, 'main', 'Reading Musashi by Eiji Yoshikawa');
    assertSeeIn($response, 'main', 'Solid Unleashed');
});

test('Tasks', function () {
    $response = $this->get('/tasks');

    $response->assertStatus(200);
    assertSeeIn($response, 'main', 'All Tasks');
    assertSeeIn($response, 'main', 'Reading Musashi by Eiji Yoshikawa');
    assertSeeIn($response, 'main', 'Housekeeping 2024/25');
});

test('Task comments', function () {
    $response = $this->get('/tasks/reading-musashi-by-eiji-yoshikawa');

    $response->assertStatus(200);
    assertSeeIn($response, 'main', 'Reading Musashi by Eiji Yoshikawa');
    assertSeeIn($response, 'main', 'Task started');
    assertSeeIn($response, 'main', 'Well, it is time');
    assertSeeIn($response, 'main', 'After looking over my notes');
    assertSeeIn($response, 'main', 'Task completed');
    assertSeeIn($response, 'main', 'December 14, 2018 00:55');
    assertSeeInHTML($response, '1544745341');
});

test('Content', function () {
    $this->get('/blog/10-years-as-a-software-developer')->assertStatus(200);
    $this->get('/blog/why-solid')->assertStatus(200);
    $this->get('/blog/interoperable-serendipity')->assertStatus(200);
    $this->get('/blog/the-problems-with-modals-and-how-to-solve-them')->assertStatus(200);
    $this->get('/tasks/implementing-a-recipes-manager-using-solid')->assertStatus(200);
});
