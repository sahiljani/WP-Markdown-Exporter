<?php

declare(strict_types=1);

if (! function_exists('add_action')) {
    function add_action(string $hook_name, $callback, int $priority = 10, int $accepted_args = 1): void
    {
    }
}

if (! function_exists('apply_filters')) {
    function apply_filters(string $hook_name, $value)
    {
        return $value;
    }
}

if (! function_exists('get_post')) {
    function get_post(int $post_id)
    {
        return null;
    }
}

if (! function_exists('current_user_can')) {
    function current_user_can(string $capability, ...$args): bool
    {
        return false;
    }
}

if (! function_exists('wp_verify_nonce')) {
    function wp_verify_nonce(string $nonce, string $action)
    {
        return true;
    }
}

if (! function_exists('get_option')) {
    function get_option(string $option, $default = false)
    {
        return $default;
    }
}

if (! function_exists('wp_strip_all_tags')) {
    function wp_strip_all_tags(string $text, bool $remove_breaks = false): string
    {
        return strip_tags($text);
    }
}

class WP_Post
{
    public string $post_content = '';
}
