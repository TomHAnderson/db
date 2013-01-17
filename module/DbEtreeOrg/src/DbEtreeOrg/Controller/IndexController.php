<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\User as UserEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Zippopotamus\Service\Zippopotamus
    ;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }
}
