<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Entity\Band as BandEntity;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class BandController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $bands = Workspace::filter($em->getRepository('Db\Entity\Band')->findBy(array(), array('name' => 'ASC')));

        return array(
            'bands' => $bands,
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($id));

        if (!$band) {
            return $this->plugin('redirect')->toRoute('band');
        }

        $this->getServiceLocator()->get('menu')->addRecent('bands', $band->getId());

        return array(
            'band' => $band
        );
    }

    public function createAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $band = new BandEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($band);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($band->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $band->exchangeArray($form->getData());

                $em->persist($band);
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('bands', $band->getId());

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('bandId');
        $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($id));

        if (!$band)
            throw new \Exception("Band $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($band);
        $form->setData($band->getArrayCopy());

        $this->getServiceLocator()->get('menu')->addRecent('bands', $band->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($band->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();

                $user = $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity();

                $band->exchangeArray($form->getData());
                $em->persist($band);
                $em->flush();
                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('band', $band);
        return $viewModel;
    }

    public function deleteAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('bandId');
        $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($id));

        if (!$band) {
            return $this->plugin('redirect')->toRoute('home');
        }

        if (!sizeof($band->getAliases())
            and !sizeof($band->getLineups())
            and !sizeof($band->getPerformances())
            and !sizeof($band->getLinks())
            and !sizeof($band->getComments()))
        {

            $menu = $this->getServiceLocator()->get('menu');
            $menu->removeRecent('bands', $band->getId());

            $em->remove($band);
            $em->flush();
        }

        return $this->plugin('redirect')->toRoute('home');
    }

    public function searchJsonAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $query = $this->getRequest()->getQuery()->get('q');
        $filterNormalize = new Normalize();
        $query = $filterNormalize(trim($query));

        $bands = Workspace::filter($em->getRepository('Db\Entity\Band')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20));

        $return = array();
        $i = 0;
        foreach ($bands as $band) {
            if (++$i > 25) break;
            $return[] = array(
                'value' => $band->getId(),
                'label' => $band->getName(),
            );
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('bands', $return);

        return $jsonModel;
    }
}
