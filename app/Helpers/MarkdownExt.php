<?php

namespace App\Helpers;

use Parsedown;

class MarkdownExt extends Parsedown
{
    /**
     * Adds backwards compatibility for code that previously used Laravel-Markdown.
     *
     * @param  string $text Markdown to parse.
     * @return string
     */
    public static function convertToHtml($text)
    {
        return self::instance()->text($text);
    }

    /**
     * Extends the base Parsedown class and proxies images using the /proxy route.
     */
    protected function inlineImage($excerpt)
    {
        $img = parent::inlineImage($excerpt);

        $img['element']['attributes']['src'] = sprintf('%s?url=%s', route('imageproxy'), $img['element']['attributes']['src']);

        return $img;
    }
}
