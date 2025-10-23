<?php

use Doctrine\DBAL\Types\Type;
use Leopard\Doctrine\Types\Pgvector\PgvectorType;

if (!Type::hasType('pgvector')) {
    Type::addType('pgvector', PgvectorType::class);
}

