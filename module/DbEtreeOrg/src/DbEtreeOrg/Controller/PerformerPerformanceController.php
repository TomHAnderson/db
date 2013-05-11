<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\PerformerPerformance as PerformerPerformanceEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

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
        $performerPerformance = $em->getRepository('Db\Entity\PerformerPerformance')->find($id);

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

        $id = $this->getRequest()->getQuery()->get('id');
        $performance = $em->getRepository('Db\Entity\Performance')->find($id);
        if (!$performance)
            throw new \Exception('Cannot find performance');

        $performerId = (int)$this->getRequest()->getPost()->get('performer_id');
        $performer = $em->getRepository('Db\Entity\Performer')->find($performerId);

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
        $performerPerformance = $em->getRepository('Db\Entity\PerformerPerformance')->find($id);

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
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performerPerformance = $em->getRepository('Db\Entity\PerformerPerformance')->find($id);
        if (!$performerPerformance)
            return $this->plugin('redirect')->toUrl('/');

        $performance = $performerPerformance->getPerformance();

        $em->remove($performerPerformance);
        $em->flush();

        return $this->plugin('redirect')->toUrl('/performance/detail?id=' . $performance->getId());
    }

    public function searchJsonAction()
    {
        $query = $this->getRequest()->getQuery()->get('q');

        $filterNormalize = new Normalize();

        $query = $filterNormalize(trim($query));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $venues = $em->getRepository('Db\Entity\Venue')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20);

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
        $performanceSet = $em->getRepository('Db\Entity\PerformanceSet')->find($id);

        $sort = $this->getRequest()->getQuery()->get('sort');

        $sortOrder = 1;
        foreach (explode(',', $sort) as $key) {
            strtok($key, '_');
            $performanceSong = $em->getRepository('Db\Entity\PerformanceSong')->find(strtok('_'));
            if ($performanceSong->getPerformanceSet() == $performanceSet) $performanceSong->setSort($sortOrder ++);
        }

        $em->flush();
        die();
    }
}
