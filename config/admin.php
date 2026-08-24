<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Password
    |--------------------------------------------------------------------------
    |
    | A single shared password that guards the /admin CMS area. There is no
    | per-user login yet — see CLAUDE.md's "Conventions" section. Set
    | ADMIN_PASSWORD in .env before deploying; the fallback below is only
    | for local development.
    |
    */
    'password' => env('ADMIN_PASSWORD', 'sevo-admin'),
];
