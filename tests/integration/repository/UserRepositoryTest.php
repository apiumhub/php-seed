<?php
/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 23/06/15
 * Time: 16:54
 */

namespace tests\integration\repository;


use domain\model\User;
use infrastructure\repository\UserRepository;

abstract class RepositoryTestBase extends \PHPUnit_Framework_TestCase
{
    const TESTING_ENVIRONMENT = "testing";

    protected function setUp()
    {
        $this->runMigrations();
        $sut = $this->createSut();
        $sut->setEnvironment(self::TESTING_ENVIRONMENT);
        $sut->startTransaction();
        //$sut->truncateDb();
        $this->sut=$sut;
    }
    protected function tearDown()
    {
        $this->sut->rollbackTransaction();
    }

    protected function runMigrations()
    {
        ini_set('include_path', get_include_path() . PATH_SEPARATOR . '/home/christian/workspace/php-dexeus-seed/');
        $app = require __DIR__ . '/../../../vendor/robmorgan/phinx/app/phinx.php';
        $_SERVER['argv'] = ["php", "migrate", "-e", self::TESTING_ENVIRONMENT];
        $app->setAutoExit(false);
        $app->run();
    }

    /**
     * @return RepositoryBase
     */
    protected abstract function createSut();
}

class UserRepositoryTest extends RepositoryTestBase
{

    public function test_saveAndRetrieve_nonPersistentObject_shouldSave()
    {
        $entity = new User("some name", 8);
        $this->sut->save($entity);
        $id=$entity->getId();
        $retrieved=$this->sut->find($id);
        $this->assertEquals(json_encode($entity), json_encode($retrieved));
    }

    /**
     * @return RepositoryBase
     */
    protected function createSut()
    {
        $sut = new UserRepository();
        return $sut;
    }
}