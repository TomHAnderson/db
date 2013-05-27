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

        $performances = $em->getRepository('Db\Entity\Performance')->findBy(array(), array('id' => 'desc'), 10);

        return array(
            'performances' => $performances,
        );
    }

    public function menuAction() {
        $menu = $this->getServiceLocator()->get('menu');

        $recent = $menu->getRecent();

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('recent', $recent);
        return $viewModel;

    }
}
