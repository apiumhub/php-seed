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
    private $sut;
    private $repository;

    public function setUp()
    {
        $this->repository = $this->getMock("domain\\services\\IUserRepository");
        $this->sut = new UserApplicationService($this->repository);
    }

    public function test_createUser_called_callsSaveOnRepository()
    {
        $this->repository
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
        $this->sut->createUser("aName", 18);
    }

    public function test_createUser_userCreated_returnUserId()
    {
        $this->repository
            ->expects($this->any())
            ->method("save");
        $actual=$this->sut->createUser("aName", 18);
        $this->assertNotEmpty($actual);
    }

}