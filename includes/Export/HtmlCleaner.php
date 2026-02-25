<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Export;

final class HtmlCleaner
{
    public function clean(string $html): string
    {
        $without_script = preg_replace('#<script[^>]*>.*?</script>#is', '', $html) ?: '';
        $without_style  = preg_replace('#<style[^>]*>.*?</style>#is', '', $without_script) ?: '';

        return trim($without_style);
    }
}
