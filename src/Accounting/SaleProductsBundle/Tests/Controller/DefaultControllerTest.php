<?php

namespace Accounting\SaleProductsBundle\Tests\Controller;

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
            '"price_date":"2014-07-28T07:38:55.758Z",'.
            '"product":{"id":1,'.
                '"code":"123",'.
                '"name":"test as",'.
                '"last_sale_price":"270.00",'.
                '"last_local_price":"144.00",'.
                '"last_stock":"30.00",'.
                '"last_add_date":{"date":"2014-06-01 00:00:00","timezone_type":3,"timezone":"UTC"},'.
                '"description":"asdfasdfasdf",'.
                '"unit":{"id":1,"name":"ml"}},'.
            '"customer":{"id":1,"name":"test2 Andrei"},'.
            '"unit":"",'.
            '"quantity":"1",'.
            '"sale_price":15,'.
            '"local_price":15,'.
            '"amount":40,'.
            '"real_amount":42,'.
            '"code":"123"}]';

        $crawler = $client->request(
                'PUT', '/service/sale/product/create', array(), array(), 
                array('CONTENT_TYPE' => 'application/json'), 
                $models
        );

//        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
}
