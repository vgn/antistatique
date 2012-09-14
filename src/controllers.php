<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$localeRegExp = '(fr|en)'; 

$app->get('/', function () use ($app) {
    $locale = 'fr';

    return $app->redirect($app['url_generator']->generate('homepage_i18n', array(
        '_locale' => $locale
    )));
})
->bind('homepage')
;

$app->get('/{_locale}/', function () use ($app) {
    try {
        $blog = $app['blog'];
        $latestPost = $blog->item[0];
    } catch (\Exception $e) {
        $latestPost = null;
    }
    
    return $app['twig']->render('index.html.twig', array(
        'latestBlogpost' => $latestPost,
    ));
})
->bind('homepage_i18n')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/team', function () use ($app) {
    return $app['twig']->render('team.html.twig', array());
})
->bind('team')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/contact', function () use ($app) {
    return $app['twig']->render('contact.html.twig', array());
})
->bind('contact')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/portfolio/{slug}', function ($slug) use ($app) {

    $template = 'portfolio/'.$slug.'.html.twig';

    try {
        $response = $app['twig']->render($template, array());
    } catch (\Twig_Error_Loader $e) {
        // like the template is not found
        $app->abort(404, sprintf('Template "%s" not found', $template)); 
    }

    return $response;
})
->bind('portfolio_show')
->assert('_locale', $localeRegExp)
->assert('slug', '[a-zA-Z0-9\-]+');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response(file_get_contents(__DIR__.'/../templates/'.$page), $code);
});