<?php

use Silex\Provider\MonologServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../antistatique.log',
));

$app['twitter'] = array(
    'username' => 'antistatique',
    'hashtag' => '',
    'api_key' => 'QONcBRXXJBw8o3uzK2atQ' // https://dev.twitter.com/apps/3088947 (logged as antistatique)
);

$app['analytics'] = null;
