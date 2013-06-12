<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\PerformerLineup as PerformerLineupEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class PerformerLineupController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performerLineupId');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performerLineup = Workspace::filter($em->getRepository('Db\Entity\PerformerLineup')->find($id));

        if (!$performerLineup)
            throw new \Exception("Performer Lineup $id not found");

        return array(
            'performerLineup' => $performerLineup
        );
    }

    public function createAction()
    {
        $performerLineup = new PerformerLineupEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performerLineup);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('lineupId');
        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));
        if (!$lineup)
            throw new \Exception('Cannot find lineup');

        $performerId = (int)$this->getRequest()->getPost()->get('performer_id');
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));

        if ($performer and $lineup and $this->getRequest()->isPost()) {

            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performerLineup->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performerLineup->exchangeArray($form->getData());
                $performerLineup->setPerformer($performer);
                $performerLineup->setLineup($lineup);

                $em->persist($performerLineup);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('lineup', $lineup);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performerLineupId');
        $performerLineup = Workspace::filter($em->getRepository('Db\Entity\PerformerLineup')->find($id));

        if (!$performerLineup)
            throw new \Exception("Performer Lineup $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performerLineup);
        $form->setData($performerLineup->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performerLineup->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performerLineup->exchangeArray($form->getData());

                $em->persist($performerLineup);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('performerLineup', $performerLineup);
        return $viewModel;
    }

    public function deleteAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performerLineupId');
        $performerLineup = Workspace::filter($em->getRepository('Db\Entity\PerformerLineup')->find($id));
        if (!$performerLineup) {
            return $this->plugin('redirect')->toRoute('home');
        }

        $lineup = $performerLineup->getLineup();

        $em->remove($performerLineup);
        $em->flush();

        return $this->plugin('redirect')->toRoute('/lineup/detail', array(
            'id' => $lineup->getId()
        ));
    }

    public function sortPerformanceSetSongsAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceId');
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
