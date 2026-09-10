<?php

namespace App\Services;

class AlternateUrlsService
{
    /**
     * @var array<string, array{url: string, type: ?string, title: ?string}>
     */
    protected array $urls = [];

    public function add(string $url, ?string $type = null, ?string $title = null): self
    {
        $key = ($type ?? '') . ':' . $url;

        $this->urls[$key] = [
            'url' => $url,
            'type' => $type,
            'title' => $title,
        ];

        return $this;
    }

    public function markdown(string $url): self
    {
        return $this->add($url, 'text/markdown');
    }

    /**
     * @return array<int, array{url: string, type: ?string, title: ?string}>
     */
    public function all(): array
    {
        return array_values($this->urls);
    }

    public function has(string $url): bool
    {
        return array_any($this->urls, fn (array $item): bool => $item['url'] === $url);
    }

    public function clear(): self
    {
        $this->urls = [];

        return $this;
    }

    public function render(): string
    {
        if ($this->urls === []) {
            return '';
        }

        $html = [];

        foreach ($this->urls as $item) {
            $attributes = ['rel="alternate"'];

            if (! empty($item['type'])) {
                $attributes[] = 'type="' . htmlspecialchars($item['type'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '"';
            }

            if (! empty($item['title'])) {
                $attributes[] = 'title="' . htmlspecialchars($item['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '"';
            }

            $attributes[] = 'href="' . htmlspecialchars($item['url'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '"';

            $html[] = '<link ' . implode(' ', $attributes) . ' />';
        }

        return implode("\n", $html);
    }
}
