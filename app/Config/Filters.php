<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;
use App\Filters\RateLimitFilter;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>>
     *
     * [filter_name => classname]
     * or [filter_name => [classname1, classname2, ...]]
     */
    /**
     * Daftar alias untuk filter classes
     * Memudahkan penggunaan filter dengan nama yang lebih sederhana
     * 
     * @var array<string, class-string|list<class-string>>
     */
    public array $aliases = [
        'csrf'          => CSRF::class, // Cross-Site Request Forgery protection
        'toolbar'       => DebugToolbar::class, // Debug toolbar untuk development
        'honeypot'      => Honeypot::class, // Honeypot untuk mencegah spam
        'invalidchars'  => InvalidChars::class, // Filter karakter tidak valid
        'secureheaders' => SecureHeaders::class, // Security headers
        'cors'          => Cors::class, // Cross-Origin Resource Sharing
        'forcehttps'    => ForceHTTPS::class, // Force HTTPS
        'pagecache'     => PageCache::class, // Page caching
        'performance'   => PerformanceMetrics::class, // Performance metrics
        'auth'          => AuthFilter::class, // Custom: Filter autentikasi user
        'ratelimit'     => RateLimitFilter::class, // Custom: Filter rate limiting
    ];

    /**
     * List of special required filters.
     *
     * The filters listed here are special. They are applied before and after
     * other kinds of filters, and always applied even if a route does not exist.
     *
     * Filters set by default provide framework functionality. If removed,
     * those functions will no longer work.
     *
     * @see https://codeigniter.com/user_guide/incoming/filters.html#provided-filters
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            'forcehttps', // Force Global Secure Requests
            'pagecache',  // Web Page Caching
        ],
        'after' => [
            'pagecache',   // Web Page Caching
            'performance', // Performance Metrics
            'toolbar',     // Debug Toolbar
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array{
     *     before: array<string, array{except: list<string>|string}>|list<string>,
     *     after: array<string, array{except: list<string>|string}>|list<string>
     * }
     */
    /**
     * Filter yang diterapkan secara global pada semua request
     * Filter 'before' dijalankan sebelum request diproses
     * Filter 'after' dijalankan setelah request diproses
     * 
     * @var array{
     *     before: array<string, array{except: list<string>|string}>|list<string>,
     *     after: array<string, array{except: list<string>|string}>|list<string>
     * }
     */
    public array $globals = [
        'before' => [
            // 'honeypot', // Honeypot filter (disabled)
            // PENTING: CSRF protection aktif untuk semua route kecuali auth/login
            // Login di-exclude karena akan dihandle manual di controller
            'csrf' => ['except' => ['auth/login']],
            'invalidchars', // Filter karakter tidak valid
        ],
        'after' => [
            // 'honeypot', // Honeypot filter (disabled)
            'secureheaders', // Tambahkan security headers ke response
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'POST' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [];
}
