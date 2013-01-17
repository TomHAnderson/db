<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Country as CountryEntity
    , Zend\Form\Annotation\AnnotationBuilder;

class CountryController extends AbstractActionController
{
    public function indexAction()
    {
        $modelCountry = $this->getServiceLocator()->get('modelCountry');

        return array(
            'countries' => $modelCountry->findAll(),
        );
    }

    public function createAction()
    {
        $modelUser = $this->getServiceLocator()->get('modelUser');
        $modelCountry = $this->getServiceLocator()->get('modelCountry');

        $user = $modelUser->getAuthenticatedUser();
        if (!$user) {
            return $this->plugin('redirect')->toUrl('/user/login?redirect=/country/create');
        }

        $country = new CountryEntity;

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($country);

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
            $form->setInputFilter($modelCountry->getInputFilter($country));

            if ($form->isValid()) {
                $data = $form->getData();
                $country->exchangeArray($form->getData());

                $modelCountry->create($country);
                return $this->plugin('redirect')->toUrl('/state?countryId=' . $country->getId());
            }
        }

        return array(
            'form' => $form
        );
    }
}
