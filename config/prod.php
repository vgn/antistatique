<?php

// configure your app for the production environment

$app['twitter'] = array(
    'username' => 'antistatique',
    'hashtag' => '',
    'api_key' => 'QONcBRXXJBw8o3uzK2atQ' // https://dev.twitter.com/apps/3088947 (logged as antistatique)
);

$app['analytics'] = array(
    'account' => 'UA-4367884-3',
);

$app['blog.feed'] = 'http://antistatique.net/blog/feed/rss2';
$app['blog.cache_dir'] = __DIR__ . '/../cache';
