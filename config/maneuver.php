<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Ignored Files
    |--------------------------------------------------------------------------
    |
    | Maneuver will check .gitignore for ignore files, but you can conveniently
    | add here additional files to be ignored.
    |
    */
    'ignored' => array(
        'resources/js',
        'resources/sass',
        'database',
        'public/api-docs',
        'tests',
    ),

    /*
    |--------------------------------------------------------------------------
    | Default server
    |--------------------------------------------------------------------------
    |
    | Default server to deploy to when running 'deploy' without any arguments.
    | If this options isn't set, deployment will be run to all servers.
    |
    */
    'default' => 'dev',

    /*
    |--------------------------------------------------------------------------
    | Connections List
    |--------------------------------------------------------------------------
    |
    | Servers available for deployment. Specify one or more connections, such
    | as: 'deployment', 'production', 'stating'; each with its own credentials.
    |
    */

    'connections' => array(

        'dev' => array(
            'scheme'    => env('MANEUVER_SCHEME', 'ftp'),
            'host'      => env('MANEUVER_HOST', 'ftp.example.com'),
            'user'      => env('MANEUVER_USER', 'username'),
            'pass'      => env('MANEUVER_PASSWORD', 'secret'),
            'path'      => env('MANEUVER_PATH', '/path/to/site/'),
            'port'      => env('MANEUVER_PORT', 21),
            'passive'   => env('MANEUVER_PASSIVE', true),
        ),

    ),

);
