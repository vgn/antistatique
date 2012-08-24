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

    public function testHomepageI18nFr()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/fr/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue($crawler->filter('html:contains("Bonjour")')->count() > 0, 'Return hello in french');
    }

    public function testHomepageI18nEn()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/en/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue($crawler->filter('html:contains("Hi")')->count() > 0, 'Return hello in english');
    }

    public function testContact()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/fr/contact');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue($crawler->filter('html:contains("Lausanne")')->count() > 0, 'contain Lausanne keywords');
        $this->assertTrue($crawler->filter('html:contains("Sébeillon 9b")')->count() > 0, 'contain street');
        $this->assertTrue($crawler->filter('html:contains("hello@antistatique.net")')->count() > 0, 'contain our email address');
        $this->assertTrue($crawler->filter('html:contains("21 623 63 03")')->count() > 0, 'contain our phone');
    }

    public function testTeam()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/fr/team');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue($crawler->filter('html:contains("Alberto")')->count() > 0, 'contain Alberto');
        $this->assertTrue($crawler->filter('html:contains("Gilles")')->count() > 0, 'contain Gilles');
        $this->assertTrue($crawler->filter('html:contains("Marc")')->count() > 0, 'contain Marc');
    }
}
