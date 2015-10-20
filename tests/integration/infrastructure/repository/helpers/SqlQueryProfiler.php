<?php
namespace tests\integration\infrastructure\repository\helpers;

use Doctrine\DBAL\Logging\SQLLogger;

class SqlQueryProfiler implements SQLLogger
{
    private $start;
    private $sql;
    private $params;
    private $types;

    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->sql = $sql;
        $this->start = microtime(true);
        $this->params = $params;
        $this->types = $types;
    }

    public function stopQuery()
    {
        var_dump(
            array(
                'sql'        => $this->sql,
                'query_time' => microtime(true) - $this->start,
                'params'     => $this->params,
                'types'      => $this->types
            )
        );
    }
}