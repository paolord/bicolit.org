<?php

class PageTest extends BaseControllerTestCase {

    public function testHomeResponse()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testAboutResponse()
    {
        $crawler = $this->client->request('GET', '/about');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testContactUsResponse()
    {
        //$crawler = $this->client->request('GET', '/contact-us');

        //$this->assertTrue($this->client->getResponse()->isOk());
    }
}
