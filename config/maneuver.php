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
    'ignored' => array(),

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
            'scheme'    => 'ftp',
            'host'      => 'ftp.sigroup.org.uk',
            'user'      => 'adminftp@307821528114837',
            'pass'      => 'p6Qx8zr-wYmsvF',
            'path'      => '/public_html/magicdesk/',
            'port'      => 21,
            'passive'   => true
        ),

    ),

);
