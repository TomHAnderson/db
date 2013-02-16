<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Entity\Performer as PerformerEntity
    ;

class PerformerController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/performer');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);

        if (!$performer)
            throw new \Exception("Performer $id not found");

        if (!isset($_SESSION['performers']['latest'])) $_SESSION['performers']['latest'] = array();
        if (in_array($performer->getId(), $_SESSION['performers']['latest'])) {
            unset($_SESSION['performers']['latest'][array_search($performer->getId(), $_SESSION['performers']['latest'])]);
        }
        array_unshift($_SESSION['performers']['latest'], $performer->getId());
        $_SESSION['performers']['latest'] = array_slice($_SESSION['performers']['latest'], 0, 10);

        return array(
            'performer' => $performer
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performer = new PerformerEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performer);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performer->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performer->exchangeArray($form->getData());

                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $em->persist($performer);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performer/detail?id=' . $performer->getId());
            }
        }

        return array(
            'form' => $form
        );
    }

    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);

        if (!$performer)
            throw new \Exception("Performer $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performer);
        $form->setData($performer->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performer->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performer->exchangeArray($form->getData());

                $em->persist($performer);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performer/detail?id=' . $performer->getId());
            }
        }

        return array(
            'form' => $form,
            'performer' => $performer,
        );
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performer = $em->getRepository('Db\Entity\Performer')->find($id);
        if (!$venue)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($performer->getPerformances())
            and !sizeof($venue->getVenueGroups())
            and !sizeof($venue->getLinks())
            and !sizeof($venue->getComments()))
        {
            $em->remove($venue);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }
}
