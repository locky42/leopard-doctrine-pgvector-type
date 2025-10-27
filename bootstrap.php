<?php

use Doctrine\DBAL\Types\Type;
use Leopard\Doctrine\EntityManager;
use Leopard\Doctrine\Types\Pgvector\PgvectorType;
use Leopard\Doctrine\Types\Pgvector\TableEventSubscriber;
use Leopard\Doctrine\Events\InitEntityManagerEvent;
use Leopard\Events\EventManager;

if (!Type::hasType('pgvector')) {
    Type::addType('pgvector', PgvectorType::class);
}

EventManager::addEvent(new InitEntityManagerEvent(), function () {
    $entityManager = EntityManager::getEntityManager();
    $conn = $entityManager->getConnection();
    $conn->executeQuery('CREATE EXTENSION IF NOT EXISTS vector;');
    $conn->getDatabasePlatform()->registerDoctrineTypeMapping('vector', 'pgvector');

    $entityManager->getEventManager()->addEventSubscriber(new TableEventSubscriber());
});
