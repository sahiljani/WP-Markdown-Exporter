<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Security;

final class Nonces
{
    public const ACTION_EXPORT = 'wp_markdown_export';

    public static function verify(string $nonce): bool
    {
        return (bool) wp_verify_nonce($nonce, self::ACTION_EXPORT);
    }
}
