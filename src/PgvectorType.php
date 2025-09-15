<?php

namespace Leopard\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class PgvectorType extends Type
{
    public const NAME = 'pgvector';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'vector(' . ($fieldDeclaration['dimension'] ?? 1536) . ')';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }
        $value = trim($value, '{}');
        if ($value === '') {
            return [];
        }
        return array_map('floatval', explode(',', $value));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }
        return '[' . implode(',', $value) . ']';
    }

    public function getName()
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
