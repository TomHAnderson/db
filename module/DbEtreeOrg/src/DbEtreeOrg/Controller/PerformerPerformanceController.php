<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\PerformerPerformance as PerformerPerformanceEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class PerformerPerformanceController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/venue');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performerPerformance = Workspace::filter($em->getRepository('Db\Entity\PerformerPerformance')->find($id));

        if (!$performerPerformance)
            throw new \Exception("Performer Performance $id not found");

        return array(
            'performerPerformance' => $performerPerformance
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performerPerformance = new PerformerPerformanceEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performerPerformance);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getRequest()->getQuery()->get('id');
        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));
        if (!$performance)
            throw new \Exception('Cannot find performance');

        $performerId = (int)$this->getRequest()->getPost()->get('performer_id');
        $performer = Workspace::filter($em->getRepository('Db\Entity\Performer')->find($performerId));

        if ($performer and $performance and $this->getRequest()->isPost()) {

            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performerPerformance->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performerPerformance->exchangeArray($form->getData());
                $performerPerformance->setPerformer($performer);
                $performerPerformance->setPerformance($performance);

                $em->persist($performerPerformance);
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
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performerPerformance = Workspace::filter($em->getRepository('Db\Entity\PerformerPerformance')->find($id));

        if (!$performerPerformance)
            throw new \Exception("Performer Performance $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performerPerformance);
        $form->setData($performerPerformance->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performerPerformance->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performerPerformance->exchangeArray($form->getData());

                $em->persist($performerPerformance);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('performerPerformance', $performerPerformance);
        return $viewModel;
    }

    public function deleteAction()
    {
    }

    public function searchJsonAction()
    {
        $query = $this->getRequest()->getQuery()->get('q');

        $filterNormalize = new Normalize();

        $query = $filterNormalize(trim($query));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $venues = Workspace::filter($em->getRepository('Db\Entity\Venue')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20));

        $return = array();
        $i = 0;
        foreach ($venues as $venue) {
            if (++$i > 25) break;
            $return[] = array(
                'value' => $venue->getId(),
                'label' => $venue->getName(),
            );
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('venues', $return);

        return $jsonModel;
    }

    public function sortPerformanceSetSongsAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
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
