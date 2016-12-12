<?php

namespace App\Helpers;

use cebe\markdown\GithubMarkdown;

class MarkdownExt extends GithubMarkdown
{
    /**
     * Adds backwards compatibility for code that previously used Laravel-Markdown.
     *
     * @param  string $text Markdown to parse.
     * @return string
     */
    public static function convertToHtml($text)
    {
        $md = new self;
        return $md->parse(htmlspecialchars($text));
    }

    /**
     * Proxies images through the web server.
     */
    protected function renderImage($block)
    {
        $block['url'] = sprintf('%s?url=%s', route('imageproxy'), $block['url']);

        return parent::renderImage($block);
    }
}
