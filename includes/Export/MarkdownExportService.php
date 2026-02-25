<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Export;

use WPMarkdownExporter\Services\ServiceInterface;

final class MarkdownExportService implements ServiceInterface
{
    private ContentRenderer $renderer;

    private HtmlCleaner $cleaner;

    private MarkdownConverterInterface $converter;

    public function __construct()
    {
        $this->renderer  = new ContentRenderer();
        $this->cleaner   = new HtmlCleaner();
        $this->converter = new BasicMarkdownConverter();
    }

    public function register(): void
    {
        // Service currently consumed by endpoint/UI services.
    }

    /**
     * @param array<string, mixed> $options
     */
    public function export(int $post_id, array $options = []): string
    {
        $html = $this->renderer->render($post_id);
        $html = $this->cleaner->clean($html);

        return $this->converter->convert($html);
    }
}
