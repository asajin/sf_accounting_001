<?php

namespace Accounting\SuppliersProductsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
    
    public function testCreate()
    {
        $client = static::createClient();
        
        $models = '[{"id":"",'.
            '"price_date":"2014-07-20T13:35:00.695Z",'.
            '"supplier":{"id":2,"name":"test1"},'.
            '"product":{"id":3,'.
                '"code":"456",'.
                '"name":"test as",'.
                '"last_sale_price":"25.00",'.
                '"last_local_price":"25.00",'.
                '"last_stock":"23.00",'.
                '"last_add_date":{"date":"2013-08-27 00:00:00","timezone_type":3,"timezone":"Europe/Brussels"},'.
                '"description":"adfasdfasdf","unit":{"id":1,"name":"ml"}},'.
            '"unit":"",'.
            '"stock":"2",'.
            '"currency_price":10,'.
            '"local_price":10,'.
            '"sale_price":11,'.
            '"amount":20,'.
            '"currency_rate":1}]';

        $crawler = $client->request(
                'PUT', '/service/sp/create', array(), array(), 
                array('CONTENT_TYPE' => 'application/json'), 
                $models
        );

//        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
}
