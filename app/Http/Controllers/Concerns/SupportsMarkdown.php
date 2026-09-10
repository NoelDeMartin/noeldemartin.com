<?php

namespace App\Http\Controllers\Concerns;

use App\Support\Facades\AlternateUrls;
use Illuminate\Http\Response;
use Statamic\Entries\Entry;
use Statamic\Facades\GlobalSet;
use Statamic\Globals\GlobalSet as GlobalSetModel;
use Statamic\Globals\Variables;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\Yaml\Yaml;

trait SupportsMarkdown
{
    /**
     * @return array{0: string, 1: bool}
     */
    public function parseSlug(string $slug): array
    {
        $isMarkdown = str_ends_with($slug, '.md');

        return [$isMarkdown ? substr($slug, 0, -3) : $slug, $isMarkdown];
    }

    public function prefersMarkdown(): bool
    {
        return in_array(
            request()->prefers(['text/html', 'text/markdown', 'text/x-markdown']),
            ['text/markdown', 'text/x-markdown'],
            true,
        );
    }

    public function advertiseMarkdown(string $url): void
    {
        AlternateUrls::markdown($url);
    }

    public function withMarkdownHeaders(SymfonyResponse $response, string $markdownUrl): SymfonyResponse
    {
        $this->advertiseMarkdown($markdownUrl);

        $path = parse_url($markdownUrl, PHP_URL_PATH) ?: $markdownUrl;
        $response->headers->set('Link', "<{$path}>; rel=\"alternate\"; type=\"text/markdown\"", false);
        $response->headers->set('Vary', 'Accept', false);

        return $response;
    }

    /**
     * @param  array<string, mixed>  $frontmatter
     */
    public function markdownResponse(array $frontmatter, string $body, ?string $canonicalUrl = null): Response
    {
        $filteredFrontmatter = array_filter(
            $frontmatter,
            fn ($value): bool => ! is_null($value) && $value !== '',
        );

        $markdown = "---\n" . trim(Yaml::dump($filteredFrontmatter)) . "\n---\n\n" . trim($body) . "\n";
        $tokens = (int) ceil(mb_strlen($markdown) / 4);

        $headers = [
            'Content-Type' => 'text/markdown; charset=utf-8',
            'Vary' => 'Accept',
            'x-markdown-tokens' => (string) $tokens,
            'Content-Signal' => 'search=yes, ai-input=yes, ai-train=yes',
        ];

        if ($canonicalUrl !== null) {
            $path = parse_url($canonicalUrl, PHP_URL_PATH) ?: $canonicalUrl;
            $headers['Link'] = "<{$path}>; rel=\"canonical\"";
        }

        return new Response($markdown, 200, $headers);
    }

    public function markdownBodyFromEntry(Entry $entry): string
    {
        $rawContent = $entry->value('content') ?? $entry->get('content');
        $body = is_string($rawContent) ? $rawContent : '';

        return $this->cleanMarkdownBody($body);
    }

    public function cleanMarkdownBody(string $body): string
    {
        $contact = GlobalSet::findByHandle('contact');
        $contactSite = $contact instanceof GlobalSetModel ? $contact->inDefaultSite() : null;
        $email = $contactSite instanceof Variables ? $contactSite->get('email') : null;
        $contactEmail = is_string($email) ? $email : config()->string('mail.from.address', 'hey@noeldemartin.com');

        $body = str_replace(
            ['{{contact.email}}', '{{contact:email}}'],
            $contactEmail,
            $body,
        );

        $body = str_replace(
            ["{{ noparse }}\n", '{{ noparse }}', "{{ /noparse }}\n", '{{ /noparse }}'],
            '',
            $body,
        );

        $body = preg_replace('/\{\{\s*partial[:\s][^}]+\/\}\}/', '', $body) ?? $body;

        return preg_replace('/\{\{\s*partial[:\s][^}]+\}\}[\s\S]*?\{\{\s*\/partial:[^}]+\}\}/', '', $body) ?? $body;
    }
}
