<?php

namespace App\Nova\Fields;

use App\Support\Parsedown;

use Laravel\Nova\Fields\Markdown as NovaMarkdown;
use Laravel\Nova\Http\Requests\NovaRequest;

class Markdown extends NovaMarkdown
{
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        if ($attribute !== 'ComputedField') {
            $this->attribute = $this->attribute . '_markdown';
        }
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        parent::fillAttributeFromRequest($request, $requestAttribute, $model, $attribute);

        if ($request->exists($requestAttribute)) {
            $value = $request[$requestAttribute];
            $htmlAttribute = str_replace('markdown', 'html', $attribute);

            $model->{$htmlAttribute} = $this->isNullValue($value)
                ? null
                : $this->convertMarkdownToHtml($value);
        }
    }

    private function convertMarkdownToHtml($markdown)
    {
        return Parsedown::render($markdown);
    }
}
