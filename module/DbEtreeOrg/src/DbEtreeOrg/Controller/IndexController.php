<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\User as UserEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repositoryUser = $em->getRepository('Db\Entity\User');

        //print_r(($repositoryUser->find(1)));die();

        return array();
    }
}
