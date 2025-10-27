<?php

namespace Leopard\Doctrine\Types\Pgvector\Services;

use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Schema\Column;
use Leopard\Doctrine\EntityManager;

/** Column service 
 * Class ColumnService
 * @package Leopard\Doctrine\Types\Pgvector\Services
*/
class ColumnService
{
    /**
     * Get original column size from database
     * @param string $tableName
     * @param string $columnName
     * @return int|null
     */
    public static function getOriginalColumnSize(Table|string $table, Column|string $column): ?int
    {
        if ($table instanceof Table) {
            $table = $table->getName();
        }

        if ($column instanceof Column) {
            $column = $column->getName();
        }

        $conn = EntityManager::getEntityManager()->getConnection();

        $schemaManager = $conn->createSchemaManager();
        if (!$schemaManager->tablesExist([$table])) {
           return null;
        }

        $sql = "SELECT atttypmod
                FROM pg_attribute
                WHERE attrelid = '{$table}'::regclass
                  AND attname = '{$column}'";
        $result = $conn->executeQuery($sql)->fetchOne();
        return $result !== false ? (int)$result : null;
    }

    /**
     * Update column size in database
     * @param Table $table
     * @param Column $column
     * @return void
     */
    public static function updateColumnSize(Table $table, Column $column): void
    {
        $newSize = $column->toArray()['dimension'] ?? null;
        $originalSize = self::getOriginalColumnSize($table, $column);
        if ($originalSize !== null && $originalSize !== $newSize) {
            $conn = EntityManager::getEntityManager()->getConnection();
            $sql = "ALTER TABLE {$table->getName()} ALTER COLUMN {$column->getName()} TYPE vector({$newSize})";
            $conn->executeQuery($sql);
            echo "\n\033[32m[PgVector]\033[0m Column " .
            "\033[33m{$table->getName()}.{$column->getName()}\033[0m " .
            "size update: " .
            "\033[34m{$originalSize} → {$newSize}\033[0m\n";
        }
    }
}
