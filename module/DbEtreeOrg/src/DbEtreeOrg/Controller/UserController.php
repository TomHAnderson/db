<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\User as UserEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class UserController extends AbstractActionController
{
    public function takeloginAction()
    {
        return $this->plugin('redirect')->toUrl('/user/profile');
    }

    public function takelogoutAction()
    {
        session_destroy();
        return $this->plugin('redirect')->toUrl('/');
    }

    public function profileAction()
    {
        $modelUser = $this->getServiceLocator()->get('modelUser');

        $user = $modelUser->getAuthenticatedUser();
        if (!$user)
            throw new \Exception('User is not authenticated');

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
