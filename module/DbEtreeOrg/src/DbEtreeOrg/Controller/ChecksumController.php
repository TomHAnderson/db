<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\Checksum as ChecksumEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class ChecksumController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('checksumId');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $checksum = Workspace::filter($em->getRepository('Db\Entity\Checksum')->find($id));

        if (!$checksum)
            throw new \Exception("Checksum $id not found");

        return array(
            'checksum' => $checksum
        );
    }

    public function createAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $checksum = new ChecksumEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($checksum);

        $id = $this->getEvent()->getRouteMatch()->getParam('sourceId');
        $source = Workspace::filter($em->getRepository('Db\Entity\Source')->find($id));

        if (!$source)
            throw new \Exception("Source $id not found");

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($checksum->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $checksum->exchangeArray($form->getData());
                $checksum->setSource($source);

                $em->persist($checksum);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('source', $source);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('checksumId');
        $checksum = Workspace::filter($em->getRepository('Db\Entity\Checksum')->find($id));

        if (!$checksum)
            throw new \Exception("Checksum $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($checksum);
        $form->setData($checksum->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($checksum->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $checksum->exchangeArray($form->getData());

                $em->persist($checksum);
                $em->flush();

                die();
            }
        }


        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('checksum', $checksum);
        return $viewModel;
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toRoute('zfcuser/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('checksumId');
        $checksum = Workspace::filter($em->getRepository('Db\Entity\Checksum')->find($id));
        if (!$checksum)
            return $this->plugin('redirect')->toRoute('home');

#        if (!sizeof($venue->getPerformances())
#            and !sizeof($venue->getVenueGroups())
#            and !sizeof($venue->getLinks())
#            and !sizeof($venue->getComments()))
#        {
        $sourceId = $checksum->getSource()->getId();
        $em->remove($checksum);
        $em->flush();
#        }

        return $this->plugin('redirect')->toRoute('source/detail', array(
            'id' => $sourceId
        ));
    }
}
