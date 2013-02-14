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

        if (!isset($_SESSION['venues']['latest'])) $_SESSION['venues']['latest'] = array();
        if (in_array($venue->getId(), $_SESSION['venues']['latest'])) {
            unset($_SESSION['venues']['latest'][array_search($venue->getId(), $_SESSION['venues']['latest'])]);
        }
        array_unshift($_SESSION['venues']['latest'], $venue->getId());
        $_SESSION['venues']['latest'] = array_slice($_SESSION['venues']['latest'], 0, 10);

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
}
