<?php

namespace DbEtreeOrg\View\Helper;
use Zend\View\Helper\AbstractHelper
    , Doctrine\ORM\EntityManager
    , Zend\ServiceManager\ServiceLocatorAwareInterface
    ;

abstract class AbstractFind extends AbstractHelper implements ServiceLocatorAwareInterface {
    use \Db\Model\Component\EntityManager;
    use \Db\Model\Component\ServiceLocator;
}