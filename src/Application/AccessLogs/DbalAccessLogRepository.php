<?php

namespace WouterDeSchuyter\Application\AccessLogs;

use Doctrine\DBAL\Connection;
use WouterDeSchuyter\Domain\AccessLogs\AccessLog;
use WouterDeSchuyter\Domain\AccessLogs\AccessLogRepository;

class DbalAccessLogRepository implements AccessLogRepository
{
    public const TABLE = 'access_log';

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param AccessLog $accessLog
     */
    public function add(AccessLog $accessLog)
    {
        $this->connection->insert(self::TABLE, [
            'id' => $accessLog->getId(),
            'method' => $accessLog->getMethod(),
            'path' => $accessLog->getPath(),
            'status_code' => $accessLog->getStatusCode(),
            'ip' => $accessLog->getIp(),
            'user_agent' => $accessLog->getUserAgent(),
            'timestamp' => $accessLog->getTimestamp(),
        ]);
    }
}