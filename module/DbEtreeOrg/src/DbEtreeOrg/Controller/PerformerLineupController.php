<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\PerformerLineup as PerformerLineupEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class PerformerLineupController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = $this->getRequest()->getQuery()->get('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/venue');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performanceSet = $em->getRepository('Db\Entity\PerformanceSet')->find($id);

        if (!$performanceSet)
            throw new \Exception("Performance Set $id not found");

        return array(
            'performanceSet' => $performanceSet
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performerLineup = new PerformerLineupEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performerLineup);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $lineup = $em->getRepository('Db\Entity\Lineup')->find($id);
        if (!$lineup)
            throw new \Exception('Cannot find lineup');

        $performerId = (int)$this->getRequest()->getPost()->get('performer_id');
        $performer = $em->getRepository('Db\Entity\Performer')->find($performerId);

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
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performerLineup = $em->getRepository('Db\Entity\PerformerLineup')->find($id);

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

        $id = $this->getRequest()->getQuery()->get('id');
        $performerLineup = $em->getRepository('Db\Entity\PerformerLineup')->find($id);
        if (!$performerLineup)
            return $this->plugin('redirect')->toUrl('/');

        $lineup = $performerLineup->getLineup();

        $em->remove($performerLineup);
        $em->flush();

        return $this->plugin('redirect')->toUrl('/lineup/detail?id=' . $lineup->getId());
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

    public function sortPerformanceSongsAction()
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
