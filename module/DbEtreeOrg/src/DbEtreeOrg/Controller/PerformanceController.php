<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Entity\Performance as PerformanceEntity;
use Db\Entity\PerformerPerformance as PerformerPerformanceEntity;
use Workspace\Service\WorkspaceService as Workspace;

class PerformanceController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performances = Workspace::filter(
            $em->getRepository('Db\Entity\Performance')->findBy(array(), array('performanceDate' => 'DESC', 'name' => 'ASC'))
        );

        return array(
            'performances' => $performances,
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));

        if (!$performance)
            throw new \Exception("Performance $id not found");

        $this->getServiceLocator()->get('menu')->addRecent('performances', $performance->getId());

        return array(
            'performance' => $performance
        );
    }

    public function createAction()
    {
        $performance = new PerformanceEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performance);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('lineupId');
        $lineup = Workspace::filter($em->getRepository('Db\Entity\Lineup')->find($id));

        if ($this->getRequest()->isPost()) {
            $valid = true;
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performance->getInputFilter());

            $venue_id = $this->getRequest()->getPost()->get('venue_id');
            $venue = Workspace::filter($em->getRepository('Db\Entity\Venue')->find($venue_id));
            if (!$venue) $valid = false;

            $event_id = $this->getRequest()->getPost()->get('event_id');
            $event = ($event_id) ? Workspace::filter($em->getRepository('Db\Entity\Event')->find($event_id)): null;

            if ($valid and $form->isValid()) {
                $data = $form->getData();
                $performance->exchangeArray($form->getData());
                $performance->setLineup($lineup);
                $performance->setVenue($venue);
                if ($event) $performance->setEvent($event);

                $em->persist($performance);
                $em->flush();

                return $this->plugin('redirect')->toRoute('performance/detail', array(
                    'id' =>  $performance->getId()
                ));
            }
        }

        return array(
            'form' => $form,
            'lineup' => $lineup,
        );
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceId');
        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));

        if (!$performance)
            throw new \Exception("Performance $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performance);
        $form->setData($performance->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performance->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performance->exchangeArray($form->getData());

                $em->persist($performance);
                $em->flush();

                die();
            }
        }


        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('performance', $performance);
        return $viewModel;
    }

    public function deleteAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceId');
        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));

        if (!$performance) {
            return $this->plugin('redirect')->toRoute('home');
        }

        if (!sizeof($performance->getAliases())
            and !sizeof($performance->getPerformances())
            and !sizeof($performance->getPerformances())
            and !sizeof($performance->getLinks())
            and !sizeof($performance->getComments()))
        {
            $em->remove($performance);
            $em->flush();
        }

        return $this->plugin('redirect')->toRoute('home');
    }
/*
    public function addSetAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceId');
        $performerId = $this->getRequest()->getPost()->get('performer_id');
        $returnUrl = $this->getRequest()->getPost()->get('returnUrl');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));

        $performance->getPerformers()->add($performer);
        $performer->getPerformances()->add($performance);

        $em->flush();

        return $this->plugin('redirect')->toUrl($returnUrl);
    }
*/
    public function addPerformerAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceId');
        $note = $this->getRequest()->getPost()->get('note');
        $performerId = $this->getRequest()->getPost()->get('performer_id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));
        $performerPerformance = new PerformerPerformanceEntity;

        $performerPerformance->setPerformer($performer);
        $performerPerformance->setPerformance($performance);
        $performerPerformance->setNote($note);

        $em->persist($performerPerformance);
        $em->flush();

        return $this->plugin('redirect')->toRoute('performance/detail', array(
            'id' =>  $id
        ));
    }

    public function removePerformerAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceId');
        $performerId = (int)$this->getEvent()->getRouteMatch()->getParam('performerId');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));

        $performerPerformance = Workspace::filter($em->getRepository('Db\Entity\PerformerPerformance')->findOneBy(array(
            'performer' => $performer,
            'performance' => $performance,
        )));

        $em->remove($performerPerformance);
        $em->flush();

        return $this->plugin('redirect')->toRoute('performance/detail', array(
            'id' =>  $id
        ));
    }
}
