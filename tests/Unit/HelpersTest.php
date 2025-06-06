<?php

test('Parse landmarks', function () {
    $html = <<<'EOF'
        <h2 id="level-1">
            <a href="#level-1" class="heading-permalink" aria-hidden="true" title="Permalink"></a>
            Level 1
        </h2>
        <p>Lorem Ipsum</p>
        <h3 id="level-1-1"> Level 1.1</h3>
        <p>Lorem Ipsum</p>
        <h3 id="level-1-2">Level 1.2</h3>
        <p>Lorem Ipsum</p>
        <h4 id="level-1-2-1">
            <a href="#level-1" class="heading-permalink" aria-hidden="true" title="Permalink"></a>
            <del>striked<del> Level 1.2.1
        </h4>
        <p>Lorem Ipsum</p>
        <h2 id="level-2">Level 2</h2>
        <p>Lorem Ipsum</p>
        <h4 id="level-2-0-1">Level 2.0.1</h4>
    EOF;

    expect(parse_landmarks($html))->toEqual([
        (object) [
            'level' => 2,
            'title' => 'Level 1',
            'anchor' => '#level-1',
            'children' => [
                (object) [
                    'level' => 3,
                    'title' => 'Level 1.1',
                    'anchor' => '#level-1-1',
                ],
                (object) [
                    'level' => 3,
                    'title' => 'Level 1.2',
                    'anchor' => '#level-1-2',
                    'children' => [
                        (object) [
                            'level' => 4,
                            'title' => '<del>striked<del> Level 1.2.1',
                            'anchor' => '#level-1-2-1',
                        ],
                    ],
                ],
            ],
        ],
        (object) [
            'level' => 2,
            'title' => 'Level 2',
            'anchor' => '#level-2',
            'children' => [
                (object) [
                    'level' => 3,
                    'children' => [
                        (object) [
                            'level' => 4,
                            'title' => 'Level 2.0.1',
                            'anchor' => '#level-2-0-1',
                        ],
                    ],
                ],
            ],
        ],
    ]);
});
