<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Entity\BandAlias as BandAliasEntity;
use Workspace\Service\WorkspaceService as Workspace;

class BandAliasController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('bandAliasid');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $bandAlias = Workspace::filter($em->getRepository('Db\Entity\BandAlias')->find($id));

        if (!$bandAlias)
            throw new \Exception("Band Alias $id not found");

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('bandAlias', $bandAlias->getId());

        return array(
            'bandAlias' => $bandAlias
        );
    }

    public function createAction()
    {
        $bandAlias = new BandAliasEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($bandAlias);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('bandId');
        $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($id));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($bandAlias->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $bandAlias->exchangeArray($form->getData());
                $bandAlias->setBand($band);

                $em->persist($bandAlias);
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('bands', $bandAlias->getBand()->getId());

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('band', $band);
        return $viewModel;

    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('bandAliasId');
        $bandAlias = Workspace::filter($em->getRepository('Db\Entity\bandAlias')->find($id));

        if (!$bandAlias) {
            throw new \Exception("bandAlias $id not found");
        }

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($bandAlias);
        $form->setData($bandAlias->getArrayCopy());

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('bandAlias', $bandAlias->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($bandAlias->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $bandAlias->exchangeArray($form->getData());

                $em->persist($bandAlias);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('bandAlias', $bandAlias);
        return $viewModel;
    }

    public function deleteAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('bandAliasId');
        $bandAlias = Workspace::filter($em->getRepository('Db\Entity\BandAlias')->find($id));

        if (!$bandAlias) {
            return $this->plugin('redirect')->toRoute('home');
        }

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('bandAlias', $bandAlias->getId());

        $band = $bandAlias->getBand();

        $em->remove($bandAlias);
        $em->flush();

        return $this->plugin('redirect')->toRoute('band/detail', array(
            'id' => $band->getId()
        );
    }
}
