<?php
/**
 * Uninstall cleanup for WP Markdown Exporter.
 */

declare(strict_types=1);

if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

$settings = get_option('my_llm_exporter_settings', []);

if (is_array($settings) && ! empty($settings['delete_data_on_uninstall'])) {
    delete_option('my_llm_exporter_settings');
}
