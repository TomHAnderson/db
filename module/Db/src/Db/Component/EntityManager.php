<?php

namespace Db\Component;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;

trait EntityManager
{
    private $entityManager;

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager(DoctrineEntityManager $entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }
}
