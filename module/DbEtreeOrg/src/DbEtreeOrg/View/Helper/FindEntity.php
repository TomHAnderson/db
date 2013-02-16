<?php

namespace DbEtreeOrg\View\Helper;
use DbEtreeOrg\View\Helper\AbstractFind
    ;

final class FindEntity extends AbstractFind
{
    public function __invoke($entityName, $id)
    {
        return $this->getServiceLocator()
            ->getServiceLocator()
            ->get('doctrine.entitymanager.orm_default')
            ->getRepository($entityName)
            ->find($id);
    }
}