<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Export;

final class BasicMarkdownConverter implements MarkdownConverterInterface
{
    public function convert(string $html): string
    {
        // Placeholder adapter. Replace with league/html-to-markdown in core feature branch.
        return trim(wp_strip_all_tags($html));
    }
}
