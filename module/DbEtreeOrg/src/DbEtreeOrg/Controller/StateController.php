<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\State as StateEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class StateController extends AbstractActionController
{
    public function indexAction()
    {
        $modelCountry = $this->getServiceLocator()->get('modelCountry');
        $modelState = $this->getServiceLocator()->get('modelState');

        $countryId = $this->getRequest()->getQuery()->get('countryId');
        if (!$countryId)
            return $this->plugin('redirect')->toUrl('/country');

        return array(
            'states' => $modelState->findBy(array(
                'country' => $modelCountry->find($countryId),
            )),
            'country' => $modelCountry->find($countryId),
        );
    }
}
