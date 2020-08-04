<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */



    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'publicPath' => [
            'driver' => 'local',
            'root'   => public_path('cms/kcfinder/upload/images'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'options' => ['CacheControl' => 'public,max-age=315360000']
        ],

    'gcs' => [
    'driver' => 'gcs',
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'smiling-destiny-184908'),
    'key_file' => env('GOOGLE_CLOUD_KEY_FILE',storage_path('app/analytics/service-account-credentials.json')), // optional: /path/to/service-account.json
    'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'media-news'),
    'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', null), // optional: /default/path/to/apply/in/bucket
    'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', 'https://storage.googleapis.com/media-news/'), // see: Public URLs below
],

'album' => [
    'driver' => 'gcs',
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'smiling-destiny-184908'),
    'key_file' => env('GOOGLE_CLOUD_KEY_FILE',storage_path('app/analytics/service-account-credentials.json')), // optional: /path/to/service-account.json
    'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'media-news'),
    'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', 'album'), // optional: /default/path/to/apply/in/bucket
    'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', 'https://storage.googleapis.com/media-news/album'),
],

'mastervideothumb' => [
    'driver' => 'gcs',
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'smiling-destiny-184908'),
    'key_file' => env('GOOGLE_CLOUD_KEY_FILE',storage_path('app/analytics/service-account-credentials.json')), // optional: /path/to/service-account.json
    'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'media-news'),
    'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', 'mastervideothumb'), // optional: /default/path/to/apply/in/bucket
    'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', 'https://storage.googleapis.com/media-news/mastervideothumb'),
],

'rss' => [
    'driver' => 'gcs',
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'smiling-destiny-184908'),
    'key_file' => env('GOOGLE_CLOUD_KEY_FILE',storage_path('app/analytics/service-account-credentials.json')), // optional: /path/to/service-account.json
    'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'media-news'),
    'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', 'rss'), // optional: /default/path/to/apply/in/bucket
    'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', 'https://storage.googleapis.com/media-news/rss'),
],
'newsletter' => [
    'driver' => 'gcs',
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'smiling-destiny-184908'),
    'key_file' => env('GOOGLE_CLOUD_KEY_FILE',storage_path('app/analytics/service-account-credentials.json')), // optional: /path/to/service-account.json
    'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'media-news'),
    'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', 'newsletter'), // optional: /default/path/to/apply/in/bucket
    'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', 'https://storage.googleapis.com/media-news/newsletter'),
],


    ],

];
