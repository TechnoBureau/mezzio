<?php
namespace App\Log;

use Laminas\Log\Logger;
use Doctrine\DBAL\Logging\DebugStack;

class SqlLogger extends DebugStack
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function stopQuery()
    {
        parent::stopQuery();
        $q = $this->queries[$this->currentQuery];
        $message = "Query:  ". $q['executionMS'] ." : " . $q['sql'] . " [ ". implode(', ',$q['params']) . " ]";
        $this->logger->info($message);
    }
}