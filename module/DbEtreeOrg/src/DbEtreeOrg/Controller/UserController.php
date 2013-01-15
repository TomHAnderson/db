<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Db\Entity\User as UserEntity;

use Zend\Form\Annotation\AnnotationBuilder;

class UserController extends AbstractActionController
{
    public function editAction()
    {
        $modelUser = $this->getServiceLocator()->get('modelUser');

        $user = $modelUser->getAuthenticatedUser();
        if (!$user)
            throw new \Exception('User is not authenticated');

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($user);

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
            $form->setInputFilter($modelUser->getInputFilter($user));

            if ($form->isValid()) {
                $data = $form->getData();
                $user->exchangeArray($form->getData());

                $modelUser->create($edit);
                die('created');
            }
        }

        return array(
            'form' => $form
        );
    }
}
