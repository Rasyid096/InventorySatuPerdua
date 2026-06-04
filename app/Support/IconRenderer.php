<?php

namespace App\Support;

class IconRenderer
{
    private const SVG_PATH = 'vendor/mallardduck/blade-lucide-icons/resources/svg';

    public static function render(string $name, string $class = 'w-4 h-4'): string
    {
        $slug = IconMap::toLucide($name);
        $path = base_path(self::SVG_PATH . '/' . $slug . '.svg');

        if (! is_readable($path)) {
            return self::fallback($class);
        }

        $svg = file_get_contents($path);
        $svg = preg_replace('/\s(width|height)="[^"]*"/', '', $svg) ?? $svg;

        $safeClass = htmlspecialchars($class, ENT_QUOTES, 'UTF-8');

        if (preg_match('/<svg[^>]*\sclass="/', $svg)) {
            return preg_replace(
                '/(<svg[^>]*\sclass=")([^"]*)(")/',
                '$1$2 ' . $safeClass . '$3',
                $svg,
                1
            ) ?? self::fallback($class);
        }

        return preg_replace(
            '/<svg/',
            '<svg class="' . $safeClass . '"',
            $svg,
            1
        ) ?? self::fallback($class);
    }

    private static function fallback(string $class): string
    {
        $safeClass = htmlspecialchars($class, ENT_QUOTES, 'UTF-8');

        return '<svg class="' . $safeClass . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v.01"/><path d="M12 8v4"/></svg>';
    }
}
