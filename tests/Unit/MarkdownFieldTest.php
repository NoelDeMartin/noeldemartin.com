<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Nova\Fields\Markdown;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class MarkdownFieldTest extends TestCase {

    public function testItCreatesAnchors() {
        // Arrange
        $field = new Markdown('text');
        $post = new Post();
        $text = <<<'EOF'
Would it be nice to create anchors automatically?

## Yes, it would be nice indeed
EOF;

        /** @var NovaRequest */
        $request = Mockery::mock(NovaRequest::class, function (MockInterface $mock) use ($text) {
            $mock->shouldReceive('exists')->andReturn(true);
            $mock->shouldReceive('offsetGet')->withArgs(['text_markdown'])->andReturn($text);
        });

        // Act
        $field->fill($request, $post);

        // Assert
        $this->assertEquals($text, $post->text_markdown);
        $this->assertStringContainsString('<p>Would it be nice to create anchors automatically?</p>', $post->text_html);
        $this->assertStringContainsString('<h2 id="yes-it-would-be-nice-indeed">Yes, it would be nice indeed</h2>', $post->text_html);
    }

}
