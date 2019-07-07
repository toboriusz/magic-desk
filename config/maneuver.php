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
    'default' => 'development',

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

        'development' => array(
            'scheme'    => 'ftp',
            'host'      => 'ftp.sigroup.org.uk',
            'user'      => 'adminftp@307821528114837',
            'pass'      => 'HLLQWSxd;/qxcvF\\;sdlscvbv',
            'path'      => '/magicdesk-dev',
            'port'      => 21,
            'passive'   => true
        ),

        'production' => array(
            'scheme'    => 'ftp',
            'host'      => 'ftp.sigroup.org.uk',
            'user'      => 'adminftp@307821528114837',
            'pass'      => 'HLLQWSxd;/qxcvF\\;sdlscvbv',
            'path'      => '/magicdesk',
            'port'      => 21,
            'passive'   => true
        ),

    ),

);
