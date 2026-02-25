<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Admin;

use WPMarkdownExporter\Services\ServiceInterface;

final class MenuService implements ServiceInterface
{
    public function register(): void
    {
        add_action('admin_menu', [$this, 'add_tools_page']);
    }

    public function add_tools_page(): void
    {
        add_management_page(
            __('Markdown Exporter', 'wp-markdown-exporter'),
            __('Markdown Exporter', 'wp-markdown-exporter'),
            'edit_posts',
            'wp-markdown-exporter',
            [$this, 'render_page']
        );
    }

    public function render_page(): void
    {
        echo '<div class="wrap"><h1>' . esc_html__('Markdown Exporter', 'wp-markdown-exporter') . '</h1>';
        echo '<p>' . esc_html__('Plugin skeleton is active. Export UI will be added in upcoming commits.', 'wp-markdown-exporter') . '</p></div>';
    }
}
