<?php

namespace App\Support;

/**
 * Lazy-loads marketing page content from resources/content/site_pages/
 * so each request only parses the sections (and detail pages) it needs.
 *
 * Layout:
 * - {section}.php              hub / company page
 * - {section}_pages/{slug}.php detail pages for services, technology, work
 */
class SitePages
{
    /** @var array<string, array<string, mixed>> */
    private static array $sections = [];

    /** @var array<string, array<string, mixed>> */
    private static array $pageBundles = [];

    /** @var array<string, array<string, mixed>> */
    private static array $pages = [];

    public static function get(string $key, mixed $default = null): mixed
    {
        $segments = explode('.', $key);
        $section = array_shift($segments);

        if ($section === null || $section === '') {
            return $default;
        }

        // site_pages.{section}.pages[.{slug}[.{...}]]
        if (($segments[0] ?? null) === 'pages') {
            array_shift($segments);
            $slug = $segments[0] ?? null;

            if ($slug !== null) {
                array_shift($segments);
                $page = self::page($section, $slug);
                if ($page === null) {
                    return $default;
                }

                return self::dig($page, $segments, $default);
            }

            $all = self::pages($section);

            return $all !== [] ? $all : $default;
        }

        $data = self::section($section);

        if ($segments === []) {
            return $data !== [] ? $data : $default;
        }

        return self::dig($data, $segments, $default);
    }

    /**
     * @return array<string, mixed>
     */
    public static function section(string $section): array
    {
        if (! array_key_exists($section, self::$sections)) {
            $path = resource_path('content/site_pages/' . $section . '.php');
            self::$sections[$section] = is_file($path) ? require $path : [];
        }

        return self::$sections[$section];
    }

    /**
     * All detail pages for a section (hub listing). Cached per request.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function pages(string $section): array
    {
        if (array_key_exists($section, self::$pageBundles)) {
            return self::$pageBundles[$section];
        }

        $dir = resource_path('content/site_pages/' . $section . '_pages');
        if (! is_dir($dir)) {
            self::$pageBundles[$section] = [];

            return self::$pageBundles[$section];
        }

        $pages = [];
        foreach (glob($dir . '/*.php') ?: [] as $file) {
            $slug = basename($file, '.php');
            $pages[$slug] = self::page($section, $slug) ?? [];
        }

        $order = self::section($section)['hub']['page_order']
            ?? self::section($section)['page_order']
            ?? null;

        if (is_array($order) && $order !== []) {
            $ordered = [];
            foreach ($order as $slug) {
                if (isset($pages[$slug])) {
                    $ordered[$slug] = $pages[$slug];
                    unset($pages[$slug]);
                }
            }
            $pages = $ordered + $pages;
        }

        self::$pageBundles[$section] = $pages;

        return $pages;
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function page(string $section, string $slug): ?array
    {
        $cacheKey = $section . ':' . $slug;
        if (array_key_exists($cacheKey, self::$pages)) {
            return self::$pages[$cacheKey];
        }

        $path = resource_path('content/site_pages/' . $section . '_pages/' . $slug . '.php');
        if (! is_file($path)) {
            self::$pages[$cacheKey] = null;

            return null;
        }

        $page = require $path;
        self::$pages[$cacheKey] = is_array($page) ? $page : null;

        return self::$pages[$cacheKey];
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  list<string>  $segments
     */
    private static function dig(array $data, array $segments, mixed $default): mixed
    {
        foreach ($segments as $segment) {
            if (! is_array($data) || ! array_key_exists($segment, $data)) {
                return $default;
            }
            $data = $data[$segment];
        }

        return $data;
    }
}
