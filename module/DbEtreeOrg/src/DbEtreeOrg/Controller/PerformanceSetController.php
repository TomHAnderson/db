<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\PerformanceSet as PerformanceSetEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class PerformanceSetController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceSetId');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performanceSet = Workspace::filter($em->getRepository('Db\Entity\PerformanceSet')->find($id));

        if (!$performanceSet)
            throw new \Exception("Performance Set $id not found");

        return array(
            'performanceSet' => $performanceSet
        );
    }

    public function createAction()
    {
        $performanceSet = new PerformanceSetEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performanceSet);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceId');
        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));

        if ($performance and $this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSet->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performanceSet->exchangeArray($form->getData());
                $performanceSet->setPerformance($performance);

                $em->persist($performanceSet);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('performance', $performance);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceSetId');
        $performanceSet = Workspace::filter($em->getRepository('Db\Entity\PerformanceSet')->find($id));

        if (!$performanceSet)
            throw new \Exception("Performance Set $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performanceSet);
        $form->setData($performanceSet->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSet->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performanceSet->exchangeArray($form->getData());

                $em->persist($performanceSet);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('performanceSet', $performanceSet);
        return $viewModel;
    }

    public function deleteAction()
    {
        die('not implemented');
    }

    public function sortPerformanceSetSongsAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceSetId');
        $performanceSet = Workspace::filter($em->getRepository('Db\Entity\PerformanceSet')->find($id));

        $sort = $this->getRequest()->getQuery()->get('sort');

        $sortOrder = 1;
        foreach (explode(',', $sort) as $key) {
            strtok($key, '_');
            $performanceSong = Workspace::filter($em->getRepository('Db\Entity\PerformanceSong')->find(strtok('_')));
            if ($performanceSong->getPerformanceSet() == $performanceSet) $performanceSong->setSort($sortOrder ++);
        }

        $em->flush();
        die();
    }
}
