<?php

class FeedTest extends BaseControllerTestCase {

    public function testFeedResponse()
    {
        $crawler = $this->client->request('GET', '/feed');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
