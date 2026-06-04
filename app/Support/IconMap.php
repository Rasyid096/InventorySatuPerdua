<?php

namespace App\Support;

class IconMap
{
    /** Map Font Awesome / legacy names → Lucide icon slug (without lucide- prefix) */
    public static function toLucide(string $name): string
    {
        return match ($name) {
            'sign-in-alt' => 'log-in',
            'sign-out-alt' => 'log-out',
            'file-import' => 'file-down',
            'file-export' => 'file-up',
            'balance-scale' => 'scale',
            'cloud-download-alt' => 'cloud-download',
            'info-circle' => 'info',
            'bars' => 'menu',
            'times' => 'x',
            'check-circle' => 'circle-check',
            'times-circle' => 'circle-x',
            'exclamation-triangle' => 'triangle-alert',
            'exclamation-circle' => 'circle-alert',
            'box-open' => 'package-open',
            'file-alt' => 'file-text',
            'laptop-code' => 'laptop',
            'file-pdf' => 'file-text',
            'id-badge' => 'badge',
            'chalkboard-teacher' => 'presentation',
            'laravel', 'fab-laravel' => 'code-2',
            'php', 'fab-php' => 'code',
            'css3-alt', 'fab-css3-alt' => 'palette',
            'edit' => 'pencil',
            'trash' => 'trash-2',
            'save' => 'save',
            'eye-slash' => 'eye-off',
            'chevron-down' => 'chevron-down',
            'chevron-right' => 'chevron-right',
            'chart-line' => 'trending-up',
            'print' => 'printer',
            'file-excel' => 'file-spreadsheet',
            'search' => 'search',
            'filter' => 'filter',
            'download' => 'download',
            'trash-alt' => 'trash-2',
            default => str_replace('_', '-', $name),
        };
    }
}
