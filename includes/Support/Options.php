<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Support;

final class Options
{
    public const OPTION_KEY = 'my_llm_exporter_settings';

    /**
     * @return array<string, mixed>
     */
    public static function get(): array
    {
        $options = get_option(self::OPTION_KEY, []);

        return is_array($options) ? $options : [];
    }
}
