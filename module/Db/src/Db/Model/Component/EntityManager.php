<?php

namespace Db\Model\Component;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;

trait EntityManager
{
    private $entityManager;

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEm(DoctrineEntityManager $entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }
}