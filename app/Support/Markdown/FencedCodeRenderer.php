<?php

namespace App\Support\Markdown;

use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;
use Stringable;

class FencedCodeRenderer implements NodeRendererInterface
{
    public function render(Node $_node, ChildNodeRendererInterface $childRenderer): Stringable
    {
        $node = $this->castNode($_node);
        $attrs = $node->data->getData('attributes');
        $infoWords = $node->getInfoWords();
        $filename = null;

        if (count($infoWords) !== 0 && $infoWords[0] !== '') {
            $class = $infoWords[0];
            if (! str_starts_with($class, 'language-')) {
                $class = 'language-' . $class;
            }

            $attrs->append('class', $class);
        }

        if (isset($infoWords[1]) && preg_match('/^\[(.+?)\]$/', $infoWords[1], $matches)) {
            $filename = $matches[1];
        }

        return new HtmlElement(
            'pre',
            [],
            is_null($filename)
                ? new HtmlElement('code', $attrs->export(), Xml::escape($node->getLiteral()))
                :
            [
                new HtmlElement('span', ['class' => 'code-filename'], $filename),
                new HtmlElement('code', $attrs->export(), Xml::escape($node->getLiteral())),
            ],
        );
    }

    public function getXmlTagName(Node $node): string
    {
        return 'code_block';
    }

    public function getXmlAttributes(Node $_node): array
    {
        $node = $this->castNode($_node);

        if (($info = $node->getInfo()) === null || $info === '') {
            return [];
        }

        return ['info' => $info];
    }

    private function castNode(Node $node): FencedCode
    {
        FencedCode::assertInstanceOf($node);

        return $node;
    }
}
