<?php
/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 23/06/15
 * Time: 16:54
 */

namespace tests\integration\infrastructure\repository;


use domain\model\User;
use infrastructure\repository\UserRepository;
use tests\integration\infrastructure\repository\base\RepositoryTestBase;

class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    use RepositoryTestBase;

    public function test_saveAndRetrieve_nonPersistentObject_shouldSave()
    {
        $entity = new User("some name", 8);
        $this->sut->save($entity);
        $id = $entity->getId();
        $this->sut->clearCache();  //first level cache confirmed with Profiler
        $retrieved = $this->sut->find($id);
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