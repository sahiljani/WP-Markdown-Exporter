<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Security;

final class Capabilities
{
    public static function can_export_post(int $post_id): bool
    {
        return current_user_can('edit_post', $post_id);
    }
}
