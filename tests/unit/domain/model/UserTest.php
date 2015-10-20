<?php
use domain\model\User;

/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 20/10/15
 * Time: 16:07
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function test_toJSON_called_returnsJSON()
    {
        $sut = User::create("a name", 18);
        $actual = $sut->toJSON();
        $this->assertRegExp(
            '/{"id":null,"name":"a name","age":18,"userId":"[^"]+"}/',
            $actual
        );
    }
}