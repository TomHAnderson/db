<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $performances = Workspace::filter($em->getRepository('Db\Entity\Performance')->findBy(array(), array('id' => 'desc'), 10));
        $sources = Workspace::filter($em->getRepository('Db\Entity\Source')->findBy(array(), array('id' => 'desc'), 10));

        return array(
            'performances' => $performances,
            'sources' => $sources,
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
