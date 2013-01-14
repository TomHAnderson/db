<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DbApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Db\Entity\User as UserEntity;

use Zend\Form\Annotation\AnnotationBuilder;

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

            die('valid');
        }

        return array(
            'form' => $form
        );
    }
}
