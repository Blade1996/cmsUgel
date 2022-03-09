<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/',
        '/admin/dashboard/verify-curr-pwd',
        '/admin/dashboard/upd-section-status',
        '/admin/dashboard/slider/upd-slider-order',
        '/admin/dashboard/units/order',
        'admin/dashboard/update-pwd',
        'admin/dashboard/upd-section-status',
        'admin/dashboard/upd-partner-status',
        'admin/dashboard/upd-slider-status',
        'admin/dashboard/upd-article-status',
        'admin/dashboard/upd-advertisement-status',
        'admin/dashboard/upd-advertising-status',
        'admin/dashboard/upd-normativity-status',
        'admin/dashboard/upd-announcement-status',
        'admin/dashboard/upd-auxiliar-status',
        'admin/dashboard/upd-covid-status',
        'admin/dashboard/upd-control-status',
        'admin/dashboard/upd-contract-status',
        'admin/dashboard/upd-link-status',
        'admin/dashboard/upd-rotate-status',
        'admin/dashboard/upd-election-status',
        'admin/dashboard/upd-charge-status',
        'admin/dashboard/upd-reassign-status',
    ];
}
