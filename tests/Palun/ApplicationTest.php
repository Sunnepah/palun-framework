<?php

/**
 * Created by PhpStorm.
 * User: sunnepah
 * Date: 6/12/16
 * Time: 2:19 AM
 */

/**
 * Class ApplicationTest.
 */ 
class ApplicationTest extends TestCase
{

    public function testApplicationInstanceCreated() {
        $this->assertInstanceOf(Application::class, Application::singleton());
    }
}
