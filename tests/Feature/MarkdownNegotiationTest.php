<?php

test('Blog post markdown URL', function () {
    $response = $this->get('/blog/starting-something-new.md');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    $response->assertHeader('Vary', 'Accept');
    $response->assertHeader('Content-Signal', 'search=yes, ai-input=yes, ai-train=yes');
    $response->assertHeader('x-markdown-tokens');
    $response->assertHeader('Link', '</blog/starting-something-new>; rel="canonical"');

    $content = $response->getContent();
    expect($content)->toStartWith("---\n");
    expect($content)->toContain("title: 'Starting Something New'");
    expect($content)->toContain('There is a feeling I enjoy a lot. The feeling of Starting Something New.');
    expect($content)->toContain('hey@noeldemartin.com');
    expect($content)->not->toContain('{{contact.email}}');
});

test('Blog post content negotiation with Accept header', function () {
    $response = $this->withHeader('Accept', 'text/markdown')->get('/blog/starting-something-new');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    $response->assertHeader('Vary', 'Accept');
    $response->assertHeader('Content-Signal', 'search=yes, ai-input=yes, ai-train=yes');
    $response->assertHeader('x-markdown-tokens');
    expect($response->getContent())->toContain("title: 'Starting Something New'");
});

test('Blog post HTML response advertises markdown alternate Link header and tag', function () {
    $response = $this->get('/blog/starting-something-new');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
    $response->assertHeader('Vary', 'Accept');
    expect($response->headers->all('Link'))->toContain('</blog/starting-something-new.md>; rel="alternate"; type="text/markdown"');
    $response->assertSee('type="text/markdown"', false);
    $response->assertSee('href="' . url('/blog/starting-something-new.md') . '"', false);
});

test('Static markdown page URL and negotiation', function () {
    $mdResponse = $this->get('/japan-tips.md');
    $mdResponse->assertStatus(200);
    $mdResponse->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    expect($mdResponse->getContent())->toContain("title: 'Japan tips'");
    expect($mdResponse->getContent())->toContain('tips for traveling to Japan');

    $negotiatedResponse = $this->withHeader('Accept', 'text/markdown')->get('/japan-tips');
    $negotiatedResponse->assertStatus(200);
    $negotiatedResponse->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    expect($negotiatedResponse->getContent())->toEqual($mdResponse->getContent());
});

test('Project markdown URL and negotiation', function () {
    $mdResponse = $this->get('/projects/geemba.md');
    $mdResponse->assertStatus(200);
    $mdResponse->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    expect($mdResponse->getContent())->toContain('title: Geemba');
    expect($mdResponse->getContent())->toContain('granting access to sport facilities');

    $negotiatedResponse = $this->withHeader('Accept', 'text/markdown')->get('/projects/geemba');
    $negotiatedResponse->assertStatus(200);
    $negotiatedResponse->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    expect($negotiatedResponse->getContent())->toEqual($mdResponse->getContent());
});

test('Task markdown URL and negotiation', function () {
    $response = $this->get('/tasks/reading-musashi-by-eiji-yoshikawa.md');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    $content = $response->getContent();
    expect($content)->toContain("title: 'Reading Musashi by Eiji Yoshikawa'");
    expect($content)->toContain('completed:');
    expect($content)->toContain('I first heard about this book');
    expect($content)->toContain('## Activity');
    expect($content)->toContain('Task started');
    expect($content)->toContain('Well, it is time. I finished part 6');
    expect($content)->toContain('Task completed');

    $negotiatedResponse = $this->withHeader('Accept', 'text/markdown')->get('/tasks/reading-musashi-by-eiji-yoshikawa');
    $negotiatedResponse->assertStatus(200);
    $negotiatedResponse->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
});

test('Talk markdown URL and negotiation', function () {
    $response = $this->get('/talks/interoperable-serendipity.md');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    $response->assertHeader('Link', '</slides/interoperable-serendipity>; rel="canonical"');
    $content = $response->getContent();
    expect($content)->toContain("title: 'Interoperable Serendipity'");
    expect($content)->toContain("conference: 'Solid World'");
    expect($content)->toContain('video_url:');
    expect($content)->toContain('slides:');
    expect($content)->toContain('I talk about [Interoperable Serendipity]');

    $negotiatedResponse = $this->withHeader('Accept', 'text/markdown')->get('/talks/interoperable-serendipity');
    $negotiatedResponse->assertStatus(200);
    $negotiatedResponse->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
});

test('Talk without slides uses talks listing as canonical', function () {
    $response = $this->get('/talks/moodle-app-testing.md');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    $response->assertHeader('Link', '</talks>; rel="canonical"');
    expect($response->getContent())->not->toContain('slides:');
});

test('Slides URLs do not serve markdown', function () {
    $this->get('/slides/interoperable-serendipity.md')->assertStatus(404);

    $response = $this->withHeader('Accept', 'text/markdown')->get('/slides/interoperable-serendipity');
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
});

test('Slides HTML advertises talks markdown alternate', function () {
    $response = $this->get('/slides/interoperable-serendipity');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
    expect($response->headers->all('Link'))->toContain('</talks/interoperable-serendipity.md>; rel="alternate"; type="text/markdown"');
    $response->assertSee('href="' . url('/talks/interoperable-serendipity.md') . '"', false);
});

test('Non-markdown entries keep sending HTML even when text/markdown is accepted', function () {
    // /blog is a listing page
    $blogResponse = $this->withHeader('Accept', 'text/markdown')->get('/blog');
    $blogResponse->assertStatus(200);
    $blogResponse->assertHeader('Content-Type', 'text/html; charset=utf-8');

    // / is the home page
    $homeResponse = $this->withHeader('Accept', 'text/markdown')->get('/');
    $homeResponse->assertStatus(200);
    $homeResponse->assertHeader('Content-Type', 'text/html; charset=utf-8');

    // /now is a dynamic activity page
    $nowResponse = $this->withHeader('Accept', 'text/markdown')->get('/now');
    $nowResponse->assertStatus(200);
    $nowResponse->assertHeader('Content-Type', 'text/html; charset=utf-8');

    // /talks is a listing page
    $talksResponse = $this->withHeader('Accept', 'text/markdown')->get('/talks');
    $talksResponse->assertStatus(200);
    $talksResponse->assertHeader('Content-Type', 'text/html; charset=utf-8');
});

test('Requesting .md on non-markdown entries or non-existent routes returns 404', function () {
    $this->get('/blog.md')->assertStatus(404);
    $this->get('/now.md')->assertStatus(404);
    $this->get('/non-existent-page.md')->assertStatus(404);
});

test('Markdown entry does not negotiate markdown for unrelated accept headers', function () {
    $response = $this->withHeader('Accept', 'application/json')->get('/blog/starting-something-new');
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
});

test('Nested talk and slide subpaths return 404', function () {
    $this->get('/talks/interoperable-serendipity/extra.md')->assertStatus(404);
    $this->withHeader('Accept', 'text/markdown')
        ->get('/talks/interoperable-serendipity/extra')
        ->assertStatus(404);
    $this->get('/slides/interoperable-serendipity/extra.md')->assertStatus(404);
    $this->withHeader('Accept', 'text/markdown')
        ->get('/slides/interoperable-serendipity/extra')
        ->assertStatus(404);
});

test('Talk markdown requested by full ID resolves normalized slides path and canonical', function () {
    $response = $this->get('/talks/interoperable-serendipity-talk.md');

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    $response->assertHeader('Link', '</slides/interoperable-serendipity>; rel="canonical"');
    $content = $response->getContent();
    expect($content)->toContain("title: 'Interoperable Serendipity'");
    expect($content)->toContain('/slides/interoperable-serendipity.pdf');
});
