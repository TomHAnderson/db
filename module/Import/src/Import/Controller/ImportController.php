<?php

namespace Import\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Country as CountryEntity
    , Db\Entity\State as StateEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class ImportController extends AbstractActionController
{
    public function countryAction()
    {
        $modelCountry = $this->getServiceLocator()->get('modelCountry');

        $countries = include __DIR__ . '/../../../../../data/import/countries.php';

        foreach ($countries as $name => $code) {
            $country = new CountryEntity;

            $country->setName($name);
            $country->setAbbrev($code);

            $modelCountry->create($country);
        }

        return $this->plugin('redirect')->toUrl('/country');
    }

    public function stateAction() {
    $modelCountry = $this->getServiceLocator()->get('modelCountry');
        $modelState = $this->getServiceLocator()->get('modelState');

        $country = $modelCountry->findOneBy(array(
                     'abbrev' => 'US'
                 ));

        $states = include(__DIR__ . '/../../../../../data/import/us_states.php');

        foreach ($states as $code => $name) {
            $state = new StateEntity;

            $state->setName($name);
            $state->setAbbrev($code);
            $state->setCountry($country);

            $modelState->create($state);
        }

        $country = $modelCountry->findOneBy(array(
                     'abbrev' => 'CA'
                 ));

        $states = include(__DIR__ . '/../../../../../data/import/ca_states.php');

        foreach ($states as $code => $name) {
            $state = new StateEntity;

            $state->setName($name);
            $state->setAbbrev($code);
            $state->setCountry($country);

            $modelState->create($state);
        }

        return $this->plugin('redirect')->toUrl('/state?countryId=' . $country->getId());
    }
}
