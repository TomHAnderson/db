<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Entity\Lineup as LineupEntity;
use Db\Entity\PerformerLineup as PerformerLineupEntity;
use Workspace\Service\WorkspaceService as Workspace;

class LineupController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('lineupId');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));

        if (!$lineup)
            throw new \Exception("Lineup $id not found");

        $this->getServiceLocator()->get('menu')->addRecent('lineups', $lineup->getId());

        return array(
            'lineup' => $lineup
        );
    }

    public function createAction()
    {
        $lineup = new LineupEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($lineup);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('bandId');
        $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($id));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($lineup->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $lineup->exchangeArray($form->getData());
                $lineup->setBand($band);

                $em->persist($lineup);
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('lineups', $lineup->getId());

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('band_id', $id);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('band', $band);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('lineupId');
        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));

        if (!$lineup)
            throw new \Exception("Lineup $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($lineup);
        $form->setData($lineup->getArrayCopy());

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('lineups', $lineup->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($lineup->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $lineup->exchangeArray($form->getData());

                $em->persist($lineup);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('lineup', $lineup);
        return $viewModel;
    }

    public function deleteAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('lineupId');
        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));
        if (!$lineup)
            return $this->plugin('redirect')->toRoute('home');

        if (!sizeof($lineup->getAliases())
            and !sizeof($lineup->getLineups())
            and !sizeof($lineup->getPerformances())
            and !sizeof($lineup->getLinks())
            and !sizeof($lineup->getComments()))
        {
            $menu = $this->getServiceLocator()->get('menu');
            $menu->addRecent('lineups', $lineup->getId());

            $em->remove($lineup);
            $em->flush();
        }

        return $this->plugin('redirect')->toRoute('home');
    }

    public function addPerformerAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('lineupId');

        $note = $this->getRequest()->getPost()->get('note');
        $performerId = $this->getRequest()->getPost()->get('performer_id');
        $returnUrl = $this->getRequest()->getPost()->get('returnUrl');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));
        $performerLineup = new PerformerLineupEntity;
        $performerLineup->setLineup($lineup);
        $performerLineup->setPerformer($performer);
        $performerLineup->setNote($note);

        $em->persist($performerLineup);
        $em->flush();

        return $this->plugin('redirect')->toUrl($returnUrl);
    }

    public function removePerformerAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('lineupId');
        $performerId = (int)$this->getEvent()->getRouteMatch()->getParam('performerId');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));

        $lineup->getPerformers()->removeElement($performer);
        $performer->getLineups()->removeElement($lineup);

        $em->flush();

        return $this->plugin('redirect')->toRoute('lineup/detail', array(
            'id' => $id
        ));
    }
}
