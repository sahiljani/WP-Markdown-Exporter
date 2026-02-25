<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Export;

interface MarkdownConverterInterface
{
    public function convert(string $html): string;
}
