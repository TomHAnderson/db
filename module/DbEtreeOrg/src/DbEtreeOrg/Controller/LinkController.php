<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\Venue as VenueEntity;
use Zend\Form\Annotation\AnnotationBuilder;

class LinkController extends AbstractActionController
{
    public function createAction()
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        if (!$auth->hasIdentity())
            throw new \Exception('User is not authenticated');

        $id = (id)$this->getRequest()->getQuery()->get('id');
        $entityName = $this->getRequest()->getQuery()->get('entityName');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $referenceName = join('', array_slice(explode('\\', $entityName), -1));
        $reference = $em->getRepository($entityName)->find($id);

        $setMethod = 'set' . $referenceName;
        $entityClass = $entityName . 'Link';

        $link = new $entityClass();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($link);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());

            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($link->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $link->exchangeArray($form->getData());
                $link->$setMethod($reference);

                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $em->persist($link);
                $em->flush();

                die(); // all ok
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('entityName', $entityName);
        return $viewModel;
    }

    public function editAction()
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        if (!$auth->hasIdentity())
            throw new \Exception('User is not authenticated');

        $id = $this->getRequest()->getQuery()->get('id');
        $entityName = $this->getRequest()->getQuery()->get('entityName');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $link = $em->getRepository('Db\Entity\AbstractLink')->find($id);

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($link);
        $form->setData($link->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());

            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($link->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $link->exchangeArray($form->getData());

                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $em->persist($link);
                $em->flush();

                die(); // all ok
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('link', $link);
        return $viewModel;
    }


    public function deleteAction()
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        if (!$auth->hasIdentity())
            throw new \Exception('User is not authenticated');

        $id = $this->getRequest()->getQuery()->get('id');
        $entityName = $this->getRequest()->getQuery()->get('entityName');
        $returnUrl = $this->getRequest()->getQuery()->get('returnUrl');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $comment = $em->getRepository($entityName)->find($id);
        if (!$comment)
            return $this->plugin('redirect')->toUrl($returnUrl);

        if ($comment->getUser() == $auth->getIdentity()) {
            $em->remove($comment);
            $em->flush();
            return $this->plugin('redirect')->toUrl($returnUrl);
        }

        die('User does not own this comment');
    }
/*
    public function editAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            throw new \Exception('User is not authenticated');

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $id = $this->getRequest()->getQuery()->get('id');
        $venue = $em->getRepository('Db\Entity\Venue')->find($id);

        if (!$venue)
            throw new \Exception("Venue $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($venue);
        $form->setData($venue->getArrayCopy());

        $form->add(array(
            'name' => 'submit',
            'attributes' => array(
                'id' => 'submit',
                'type'  => 'submit',
                'value' => 'Submit',
            ),
        ));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($venue->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $venue->exchangeArray($form->getData());

                $em->persist($venue);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/venue/detail?id=' . $venue->getId());
            }
        }

        return array(
            'form' => $form,
            'venue' => $venue,
        );
    }

*/
}
