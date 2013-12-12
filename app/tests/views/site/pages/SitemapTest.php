<?php

class SitemapTest extends BaseControllerTestCase {

    public function testSitemapResponse()
    {
        $crawler = $this->client->request('GET', '/sitemap');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
