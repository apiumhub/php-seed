<?php

namespace infrastructure\repository\base;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

abstract class RepositoryBase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    /**
     * @return EntityManager
     */
    public function createEntityManager()
    {
        $path = array($this->entityQualifiedName());
        $devMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

        // define credentials...
        //temporary
        $connectionOptions = array(
            'driver'   => 'pdo_mysql',
            'host'     => 'localhost',
            'dbname'   => 'seed_db',
            'user'     => 'root',
            'password' => 'root',
        );

        return EntityManager::create($connectionOptions, $config);
    }

    /**
     * @return string
     */
    protected abstract function entityQualifiedName();
}