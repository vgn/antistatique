<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$localeRegExp = '(fr|en)';

function localized_render($template, $params = array()) {
    global $app;
    $locale = $app['request']->getLocale();
    $defaultLocale = 'fr';

    // first try with the current locale, then default
    foreach (array($locale, $defaultLocale) as $l) {
        try {
            return $app['twig']->render(sprintf('%s/%s', $l, $template), $params);
        } catch (\Twig_Error_Loader $e) {
            // template not found, try next
        }
    }

    // fallback
    return $app['twig']->render($template, $params);
}


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
        $latestPost = $blog ? $blog->item[0] : null;
    } catch (\Exception $e) {
        $latestPost = null;
    }
    
    return localized_render('index.html.twig', array(
        'latestBlogpost' => $latestPost,
    ));
})
->bind('homepage_i18n')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/portfolio', function () use ($app) {
    return localized_render('portfolio.html.twig', array());
})
->bind('portfolio')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/team', function () use ($app) {
    return localized_render('team.html.twig', array());
})
->bind('team')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/job', function () use ($app) {
    return localized_render('job.html.twig', array());
})
->bind('job')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/job/{slug}', function ($slug) use ($app) {

    $template = sprintf('job/%s.html.twig', $slug);

    try {
        $response = localized_render($template);
    } catch (\Twig_Error_Loader $e) {
        // like the template is not found
        $app->abort(404, sprintf('Template "%s" not found', $template)); 
    }

    return $response;
})
->bind('job_show')
->assert('_locale', $localeRegExp)
->assert('slug', '[a-zA-Z0-9\-]+');


$app->get('/{_locale}/contact', function () use ($app) {
    return localized_render('contact.html.twig', array());
})
->bind('contact')
->assert('_locale', $localeRegExp);
;

$app->get('/{_locale}/portfolio/{slug}', function ($slug) use ($app) {

    $template = sprintf('portfolio/%s.html.twig', $slug);

    try {
        $response = localized_render($template);
    } catch (\Twig_Error_Loader $e) {
        // like the template is not found
        $app->abort(404, sprintf('Template "%s" not found', $template)); 
    }

    return $response;
})
->bind('portfolio_show')
->assert('_locale', $localeRegExp)
->assert('slug', '[a-zA-Z0-9\-]+');

$app->get('cache/clear', function () use ($app) {

    $cacheDir = $app['twig']->getCache();
    $finder = new Symfony\Component\Finder\Finder();

    foreach($finder->in($cacheDir)->files() as $file) {
        print "- ".$file->getRealpath()."<br>\n";
        unlink($file->getRealpath());
    }

    foreach($finder->in($cacheDir)->directories() as $file) {
        //print "- ".$file->getRealpath()."<br>\n";
        //rmdir($file->getRealpath());
    }


    $response = 'cache:clear';

    return $response;
})
->bind('cache_clear');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response(file_get_contents(__DIR__.'/../templates/'.$page), $code);
});