<?php declare(strict_types=1);

namespace Framework;

use Doctrine\DBAL\Platforms\MySQL57Platform;

final class MySQLPlatform extends MySQL57Platform
{
    public function getDateTimeFormatString(): string
    {
        return 'Y-m-d H:i:s.u';
    }
}