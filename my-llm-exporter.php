<?php
/**
 * Plugin Name: WP Markdown Exporter
 * Description: Export WordPress content as LLM-friendly Markdown.
 * Version: 0.1.0
 * Requires at least: 6.2
 * Requires PHP: 8.0
 * Author: WP Markdown Exporter
 * Text Domain: wp-markdown-exporter
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

define('WP_MARKDOWN_EXPORTER_VERSION', '0.1.0');
define('WP_MARKDOWN_EXPORTER_FILE', __FILE__);
define('WP_MARKDOWN_EXPORTER_PATH', plugin_dir_path(__FILE__));
define('WP_MARKDOWN_EXPORTER_URL', plugin_dir_url(__FILE__));

$autoload = WP_MARKDOWN_EXPORTER_PATH . 'vendor/autoload.php';

if (file_exists($autoload)) {
    require_once $autoload;
}

if (class_exists(\WPMarkdownExporter\Plugin::class)) {
    \WPMarkdownExporter\Plugin::init();
}
