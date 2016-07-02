<?php
/**
 * Created by: Sunday Ayandokun
 * Email: sunday.ayandokun@gmail.com
 * Date: 7/2/16
 * Time: 5:11 PM
 */

use Palun\Request;

class RequestTest extends \TestCase
{
    private $request;
    
    function setUp () {
        /** Set HTTP request properties */
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $this->request = new Request();
    }
    
    public function test_request_has_properties() {
        
        $this->assertEquals("/", $this->request->url);
        $this->assertEquals("GET", $this->request->method);
        $this->assertEquals("", $this->request->referrer);
    }
}
