<?php

define('CMS_SHORT_DESC_WORD_LIMIT', 200);
define('CMS_LONG_DESC_WORD_LIMIT', 6000);

function cmsCountWords(string $html): int
{
    $html = preg_replace('#<(script|style)\b[^>]*>.*?</\1>#is', '', $html);
    $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = trim($text);
    if ($text === '') {
        return 0;
    }
    return count(preg_split('/\s+/u', $text));
}
