<?php

namespace infrastructure\repository\base;

use Doctrine\DBAL\Logging\SQLLogger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

abstract class RepositoryBase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;
    private $environment = "local";

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

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

        $migrationOptions = Yaml::parse(
            file_get_contents(dirname(__FILE__) . "/../../../../phinx.yml")
        );
        $connectionOptions
            = $migrationOptions['environments'][$this->environment];
        $connectionOptions['driver'] = 'pdo_' . $connectionOptions['adapter'];
        $connectionOptions['password'] = $connectionOptions['pass'];
        $connectionOptions['dbname'] = $connectionOptions['name'];
        return EntityManager::create($connectionOptions, $config);
    }

    public function clearCache()
    {
        $this->getEntityManager()->clear();
    }

    public function setProfiler(SQLLogger $profiler)
    {
        $this->getEntityManager()->getConnection()->getConfiguration()
            ->setSQLLogger($profiler);
    }

    /**
     * @return string
     */
    protected abstract function entityQualifiedName();
}