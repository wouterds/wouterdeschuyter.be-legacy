<?php

namespace WouterDeSchuyter\Infrastructure\Database;

use Doctrine\DBAL\Logging\SQLLogger as SQLLoggerInterface;
use Exception;

class SQLLogger implements SQLLoggerInterface
{
    /**
     * @var Query
     */
    private $query;

    /**
     * @var array
     */
    private $queries = [];

    /**
     * @param string $sql The SQL to be executed.
     * @param array|null $params The SQL parameters.
     * @param array|null $types The SQL parameter types.
     * @return void
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->query = new Query($sql, $params, $types);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function stopQuery()
    {
        $this->query->markAsFinished();
        $this->queries[] = $this->query;
    }

    /**
     * @return int
     */
    public function getQueryCount(): int
    {
        return count($this->queries);
    }
}
