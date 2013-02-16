<?php

namespace DbEtreeOrg\View\Helper;
use DbEtreeOrg\View\Helper\AbstractFind
    ;

final class FindBand extends AbstractFind
{
    public function __invoke($id)
    {
        return $this->getServiceLocator()
            ->getServiceLocator()
            ->get('doctrine.entitymanager.orm_default')
            ->getRepository('Db\Entity\Band')
            ->find($id);
    }
}