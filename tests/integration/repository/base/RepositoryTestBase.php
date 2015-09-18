<?php
/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 24/07/15
 * Time: 15:46
 */
namespace tests\integration\repository\base;

use tests\integration\repository\helpers\SqlQueryProfiler;

trait RepositoryTestBase
{
    private $testingEnvironment = "testing";

    protected function setUp()
    {
        $this->runMigrations();
        $sut = $this->createSut();
        $sut->setEnvironment($this->testingEnvironment);
        $sut->setProfiler(new SqlQueryProfiler());
        $sut->startTransaction();
        //$sut->truncateDb();
        $this->sut = $sut;
    }

    protected function tearDown()
    {
        $this->sut->rollbackTransaction();
    }

    protected function runMigrations()
    {
        ini_set(
            'include_path', get_include_path() . PATH_SEPARATOR
            . '/home/christian/workspace/php-dexeus-seed/'
        );
        $app = require __DIR__
            . '/../../../../vendor/robmorgan/phinx/app/phinx.php';
        $_SERVER['argv'] = ["php", "migrate", "-e", $this->testingEnvironment];
        $app->setAutoExit(false);
        $app->run();
    }

    /**
     * @return RepositoryBase
     */
    protected abstract function createSut();
}