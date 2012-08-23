<?php

use Silex\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class ApplicationTest extends WebTestCase
{
    public function createApplication()
    {
        // Silex
        $app = require __DIR__.'/../../src/app.php';
        require __DIR__.'/../../config/dev.php';

        // Tests mode
        unset($app['exception_handler']);
        $app['translator.messages'] = array();

        // Use FilesystemSessionStorage to store session
        $app['session.storage'] = $app->share(function() {
            return new MockFileSessionStorage(sys_get_temp_dir());
        });

        // Controllers
        require __DIR__ . '/../../src/controllers.php';

        return $this->app = $app;
    }

    public function test404()
    {
        $client = $this->createClient();

        $this->setExpectedException('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
        $client->request('GET', '/give-me-a-404');
    }

    public function testHomepage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
