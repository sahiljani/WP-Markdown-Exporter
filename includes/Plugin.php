<?php

declare(strict_types=1);

namespace WPMarkdownExporter;

use WPMarkdownExporter\Admin\ListTableService;
use WPMarkdownExporter\Admin\MenuService;
use WPMarkdownExporter\Admin\PostEditorService;
use WPMarkdownExporter\Ajax\CopyEndpoint;
use WPMarkdownExporter\Export\MarkdownExportService;
use WPMarkdownExporter\Services\ServiceInterface;

final class Plugin
{
    public static function init(): void
    {
        add_action('plugins_loaded', [self::class, 'boot']);
    }

    public static function boot(): void
    {
        foreach (self::register_services() as $service) {
            if ($service instanceof ServiceInterface) {
                $service->register();
            }
        }
    }

    /**
     * @return array<int, ServiceInterface>
     */
    public static function register_services(): array
    {
        return [
            new MenuService(),
            new PostEditorService(),
            new ListTableService(),
            new MarkdownExportService(),
            new CopyEndpoint(),
        ];
    }
}
