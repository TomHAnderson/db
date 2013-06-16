<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\User as UserEntity;
use Zend\Form\Annotation\AnnotationBuilder;

class UserController extends AbstractActionController
{
    public function takelogoutAction()
    {
        session_destroy();
        return $this->plugin('redirect')->toRoute('home');
    }

    public function profileAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');

        if ($id) {
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('Db\Entity\User')->find($id);
        } else {
            $modelUser = $this->getServiceLocator()->get('modelUser');
            $user = $modelUser->getAuthenticatedUser();
        }

        return array(
            'user' => $user
        );
    }

    public function editAction()
    {
        $modelUser = $this->getServiceLocator()->get('modelUser');

        $user = $modelUser->getAuthenticatedUser();
        if (!$user)
            throw new \Exception('User is not authenticated');

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($user);
        $form->setData($user->getArrayCopy());

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
