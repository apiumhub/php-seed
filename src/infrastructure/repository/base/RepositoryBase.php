<?php

namespace infrastructure\repository\base;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

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

        $migrationOptions=Yaml::parse(file_get_contents(dirname(__FILE__)."/../../../../phinx.yml"));
        $connectionOptions=$migrationOptions['environments']['testing'];
        $connectionOptions['driver']='pdo_'.$connectionOptions['adapter'];
        $connectionOptions['password']=$connectionOptions['pass'];
        $connectionOptions['dbname']=$connectionOptions['name'];
        return EntityManager::create($connectionOptions, $config);
    }

    /**
     * @return string
     */
    protected abstract function entityQualifiedName();
}