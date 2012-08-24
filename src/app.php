<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;

$app = new Application();
$app->register(new TranslationServiceProvider(), array(
    'locale_fallback' => 'fr',
));

$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', __DIR__.'/../locales/fr.yml', 'fr');
    $translator->addResource('yaml', __DIR__.'/../locales/en.yml', 'en');

    return $translator;
}));

$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array(__DIR__.'/../templates'),
    'twig.options' => array('cache' => __DIR__.'/../cache'),
));
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addExtension(new \Antistatique\Twig\Extension\Url($app['request']));

    return $twig;
}));

return $app;
