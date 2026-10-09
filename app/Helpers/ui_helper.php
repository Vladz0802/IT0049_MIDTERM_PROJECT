<?php

/**
 * View helpers shared by every page. Load with: helper('ui');
 */

if (! function_exists('peso')) {
    /** Format a number as Philippine pesos, e.g. 1234.5 -> ₱1,234.50 */
    function peso($amount): string
    {
        return '₱' . number_format((float) $amount, 2);
    }
}

if (! function_exists('upload_url')) {
    /** Public URL of an uploaded image, or the placeholder when there isn't one. */
    function upload_url(?string $subfolder, ?string $filename): string
    {
        if (empty($filename)) {
            return base_url('images/placeholder.svg');
        }

        return base_url('uploads/' . $subfolder . '/' . rawurlencode(basename($filename)));
    }
}

if (! function_exists('delete_button')) {
    /** A POST form (with CSRF token and a confirm prompt) styled as a text link. */
    function delete_button(string $action, string $confirm, string $label = 'Delete'): string
    {
        $onsubmit = "return confirm('" . esc($confirm, 'js') . "');";

        return '<form class="inline-form" method="post" action="' . esc($action, 'attr') . '" onsubmit="' . esc($onsubmit, 'attr') . '">'
            . csrf_field()
            . '<button type="submit" class="link-danger">' . esc($label) . '</button>'
            . '</form>';
    }
}
