<?php

namespace Leopard\Doctrine\Types\Pgvector;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Tools\ToolEvents;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;
use Leopard\Doctrine\Types\Pgvector\Services\ColumnService;

/**
 * Class TableEventSubscriber
 * @package Leopard\Doctrine\Types\Pgvector
 */
class TableEventSubscriber implements EventSubscriber
{
    /**
     * @return array<string>
     */
    public function getSubscribedEvents()
    {
        return [ToolEvents::postGenerateSchema];
    }

    /**
     * @param GenerateSchemaEventArgs $eventArgs
     * @return void
     */
    public function postGenerateSchema(GenerateSchemaEventArgs $eventArgs)
    {
        foreach ($eventArgs->getSchema()->getTables() as $table) {
            foreach ($table->getColumns() as $column) {
                if (is_a($column->getType(), PgvectorType::class, true)) {
                    ColumnService::updateColumnSize($table, $column);
                }
            }
        }
    }
}
