<?php

declare(strict_types=1);

namespace WPMarkdownExporter\Export;

use WP_Post;

final class ContentRenderer
{
    public function render(int $post_id): string
    {
        $post = get_post($post_id);

        if (! $post instanceof WP_Post) {
            return '';
        }

        return (string) apply_filters('the_content', $post->post_content);
    }
}
