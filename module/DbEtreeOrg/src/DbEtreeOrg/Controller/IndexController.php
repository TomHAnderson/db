<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\User as UserEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $modelUser = $this->getServiceLocator()->get('modelUser');

        $user = new UserEntity;

        $user->setUsername('testing');
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($user);

        $form->add(array(
            'name' => 'submit',
            'attributes' => array(
                'id' => 'submit',
                'type'  => 'submit',
                'value' => 'Save',
            ),
        ));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($modelUser->getInputFilter($user));

        }

        if ($this->getRequest()->isPost() && $form->isValid()) {
            $data = $form->getData();

            $modelUser->create($user);
            die('created');
        }

        return array(
            'form' => $form
        );
    }
}
