<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Entity\Performance as PerformanceEntity
    ;

class PerformanceController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/performance');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performance = $em->getRepository('Db\Entity\Performance')->find($id);

        if (!$performance)
            throw new \Exception("Performance $id not found");

        if (!isset($_SESSION['performances']['latest'])) $_SESSION['performances']['latest'] = array();
        if (in_array($performance->getId(), $_SESSION['performances']['latest'])) {
            unset($_SESSION['performances']['latest'][array_search($performance->getId(), $_SESSION['performances']['latest'])]);
        }
        if (!isset($_SESSION['performances']['latest'])) $_SESSION['performances']['latest'] = array();
        array_unshift($_SESSION['performances']['latest'], $performance->getId());
        $_SESSION['performances']['latest'] = array_slice($_SESSION['performances']['latest'], 0, 10);

        return array(
            'performance' => $performance
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performance = new PerformanceEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performance);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $lineup = $em->getRepository('Db\Entity\Lineup')->find($id);

        if ($this->getRequest()->isPost()) {
            $valid = true;
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performance->getInputFilter());

            $venue_id = $this->getRequest()->getPost()->get('venue_id');
            $venue = $em->getRepository('Db\Entity\Venue')->find($venue_id);
            if (!$venue) $valid = false;

            $event_id = $this->getRequest()->getPost()->get('event_id');
            $event = ($event_id) ? $em->getRepository('Db\Entity\Event')->find($event_id): null;

            if ($valid and $form->isValid()) {
                $data = $form->getData();
                $performance->exchangeArray($form->getData());
                $performance->setLineup($lineup);
                $performance->setVenue($venue);
                if ($event) $performance->setEvent($event);

                $em->persist($performance);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performance/detail?id=' . $performance->getId());
            }
        }

        return array(
            'form' => $form,
            'lineup' => $lineup,
        );
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performance = $em->getRepository('Db\Entity\Performance')->find($id);

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

                return $this->plugin('redirect')->toUrl('/performance/detail?id=' . $performance->getId());
            }
        }

        return array(
            'form' => $form,
            'performance' => $performance,
        );
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performance = $em->getRepository('Db\Entity\Performance')->find($id);
        if (!$performance)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($performance->getAliases())
            and !sizeof($performance->getPerformances())
            and !sizeof($performance->getPerformances())
            and !sizeof($performance->getLinks())
            and !sizeof($performance->getComments()))
        {
            $em->remove($performance);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }

    public function addSetAction()
    {
        $id = $this->getRequest()->getPost()->get('id');
        $performerId = $this->getRequest()->getPost()->get('performer_id');
        $returnUrl = $this->getRequest()->getPost()->get('returnUrl');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $performance = $em->getRepository('Db\Entity\Performance')->find($id);
        $performer = $em->getRepository('Db\Entity\Performer')->find($performerId);


        $performance->getPerformers()->add($performer);
        $performer->getPerformances()->add($performance);

        $em->flush();

        return $this->plugin('redirect')->toUrl($returnUrl);
    }
}
