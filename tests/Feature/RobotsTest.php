<?php

test('Sitemap', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertStatus(200);
    $response->assertSee('/blog');
    $response->assertSee('/projects/geemba');
    $response->assertSee('/slides/interoperable-serendipity');
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
    $response->assertSee('Solid Unleashed');
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

test('Home SEO', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('<title>Noel De Martin</title>', false);
    $response->assertSee('In this website you\'ll find information about me', false);
    $response->assertSee('<meta property="og:site_name" content="Noel De Martin">', false);
    $response->assertSee('<meta property="og:type" content="website">', false);
    $response->assertSee('<meta name="twitter:card" content="summary">', false);
    $response->assertSee('<script type="application/ld+json">', false);
    $response->assertSee('"@type":"AboutPage"', false);
    $response->assertSee('"@type":"Blog"', false);
    $response->assertSee('"@type":"Person"', false);
});

test('Talk slides SEO', function () {
    $response = $this->get('/slides/interoperable-serendipity');

    $response->assertStatus(200);
    $response->assertSee('<title>Interoperable Serendipity | Noel De Martin</title>', false);
    $response->assertSee('I talk about Interoperable Serendipity', false);
    $response->assertSee('"@type":"PresentationDigitalDocument"', false);
});

test('Blog SEO', function () {
    $response = $this->get('/blog');

    $response->assertStatus(200);
    $response->assertSee('<title>Blog | Noel De Martin</title>', false);
    $response->assertSee('Noel De Martin\'s blog on software', false);
    $response->assertSee('<meta property="og:site_name" content="Noel De Martin">', false);
    $response->assertSee('<meta property="og:type" content="website">', false);
    $response->assertSee('<meta name="twitter:card" content="summary">', false);
    $response->assertSee('<script type="application/ld+json">', false);
    $response->assertSee('"@type":"Article"', false);
});

test('Blog post SEO', function () {
    $response = $this->get('/blog/starting-something-new');

    $response->assertStatus(200);
    $response->assertSee('<title>Starting Something New | Noel De Martin</title>', false);
    $response->assertSee('There is a feeling I enjoy a lot', false);
    $response->assertSee('<meta property="og:type" content="article">', false);
    $response->assertSee('"@type":"Article"', false);
});

test('Now SEO', function () {
    $response = $this->get('/now');

    $response->assertStatus(200);
    $response->assertSee('<title>What I\'m doing now | Noel De Martin</title>', false);
    $response->assertSee('A page where you can find out what I\'m up to now', false);
    $response->assertSee('<meta property="og:type" content="website">', false);
    $response->assertSee('"@type":"WebPage"', false);
});

test('Task comments SEO', function () {
    $response = $this->get('/tasks/reading-musashi-by-eiji-yoshikawa');

    $response->assertStatus(200);
    $response->assertSee('<title>Reading Musashi by Eiji Yoshikawa | Noel De Martin</title>', false);
    $response->assertSee('I first heard about this book on Jocko Willink\'s podcast', false);
    $response->assertSee('<meta property="og:type" content="website">', false);
    $response->assertSee('"@type":"Action"', false);
    $response->assertSee('"actionStatus":"https:\/\/schema.org\/CompletedActionStatus"', false);
});
