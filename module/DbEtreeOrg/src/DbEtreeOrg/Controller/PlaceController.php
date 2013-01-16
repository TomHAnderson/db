<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\State as StateEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class PlaceController extends AbstractActionController
{
    public function indexAction()
    {
        $modelState = $this->getServiceLocator()->get('modelState');
        $modelPlace = $this->getServiceLocator()->get('modelPlace');

        $stateId = $this->getRequest()->getQuery()->get('stateId');
        if (!$stateId)
            return $this->plugin('redirect')->toUrl('/country');

        return array(
            'places' => $modelPlace->findBy(array(
                'state' => $modelState->find($stateId),
            )),
            'state' => $modelState->find($stateId),
        );
    }
}
