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
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/lineup');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));

        if (!$lineup)
            throw new \Exception("Lineup $id not found");

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('lineups', $lineup->getId());

        return array(
            'lineup' => $lineup
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $lineup = new LineupEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($lineup);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $band_id = $this->getRequest()->getQuery()->get('id');
        $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($band_id));

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
        $viewModel->setVariable('band_id', $band_id);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('band', $band);
        return $viewModel;
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
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
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));
        if (!$lineup)
            return $this->plugin('redirect')->toUrl('/');

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

        return $this->plugin('redirect')->toUrl('/');
    }

    public function addPerformerAction()
    {
        $id = $this->getRequest()->getPost()->get('id');
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
        $id = $this->getRequest()->getPost()->get('id');
        $performerId = $this->getRequest()->getPost()->get('performer_id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));

        $lineup->getPerformers()->removeElement($performer);
        $performer->getLineups()->removeElement($lineup);

        $em->flush();

        return $this->plugin('redirect')->toUrl('/lineup/detail?id=' . $id);
    }
}
