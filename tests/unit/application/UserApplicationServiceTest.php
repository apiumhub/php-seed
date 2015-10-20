<?php
use application\UserApplicationService;

/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 20/10/15
 * Time: 13:20
 */
class UserApplicationServiceTest extends \PHPUnit_Framework_TestCase
{
    public function test_createUser_called_callsSaveOnRepository()
    {
        $repository = $this->getMock("domain\\services\\IUserRepository");
        $repository
            ->expects($this->once())
            ->method("save")
            ->will(
                $this->returnCallback(
                    function ($user) {
                        $this->assertEquals(
                            "aName - 18", $user->toInspectionString()
                        );
                    }
                )
            );
        $sut = new UserApplicationService($repository);
        $sut->createUser("aName", 18);
    }
}