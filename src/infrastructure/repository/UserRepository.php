<?php
/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 23/06/15
 * Time: 16:53
 */

namespace infrastructure\repository;

use infrastructure\repository\base;
use domain\model\User;

class UserRepository extends base\RepositoryBase
{

    /**
     * @return string
     */
    protected function entityQualifiedName()
    {
        return "domain\\model\\User";
    }

    //TODO: abstract generic DAO + extract configuration
    public function save(User $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
    public function find($id)
    {
        return $this->getEntityManager()->find($this->entityQualifiedName(), $id);
    }
    public function truncateDb()
    {
        $connection = $this->getEntityManager()->getConnection();
        $platform   = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL('users', true /* whether to cascade */));
    }
}