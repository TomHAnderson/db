<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Venue as VenueEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class VenueController extends AbstractActionController
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

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $venue = $em->getRepository('Db\Entity\Venue')->find($id);

        if (!$venue)
            throw new \Exception("Venue $id not found");

        return array(
            'venue' => $venue
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            throw new \Exception('User is not authenticated');

        $venue = new VenueEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($venue);

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

                # $venue->setPlace($place);

                $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $em->persist($venue);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/venue/detail?id=' . $venue->getId());
            }
        }

        return array(
            'form' => $form
        );
    }

    public function editAction()
    {
        $modelUser = $this->getServiceLocator()->get('modelUser');

        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            throw new \Exception('User is not authenticated');

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($user);
        $form->setData($user->getArrayCopy());

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
            $form->setInputFilter($user->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $user->exchangeArray($form->getData());

                $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $em->persist($user);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/user/profile');
            }
        }

        return array(
            'form' => $form
        );
    }
}
