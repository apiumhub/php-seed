<?php
/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 30/09/14
 * Time: 15:53
 */

namespace tests;

use HelloWorld\SayHello;

class HelloWorldLibraryTest extends \PHPUnit_Framework_TestCase
{

    public function test_sayHello_called_saysHelloToTheWorld()
    {
        $result=SayHello::world();
        $this->assertThat($result, $this->equalTo("Hello World, Composer!"));
    }
}