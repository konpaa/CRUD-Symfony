<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class PageControllerTest extends PantherTestCase
{
    public function testContentPage(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(1, $crawler->filter('h1'));
        $this->assertSelectorTextContains('h1', 'TWITTER DESTROYER');

        $client->clickLink('About');
        $this->assertSelectorTextNotContains('h1', 'CRUD Articles');
        $this->assertResponseIsSuccessful();
    }
}
