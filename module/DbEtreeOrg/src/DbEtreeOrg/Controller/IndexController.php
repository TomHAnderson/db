<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Zend\View\Model\JsonModel
    ;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return array();
    }

    public function menuAction() {
        if (!isset($_SESSION['menu'])) $_SESSION['menu'] = array();

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('menu', $_SESSION['menu']);

        return $jsonModel;
    }
}
