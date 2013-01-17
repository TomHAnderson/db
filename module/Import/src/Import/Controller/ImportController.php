<?php

namespace Import\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Country as CountryEntity
    , Db\Entity\State as StateEntity
    , Db\Entity\Place as PlaceEntity
    , Zend\Form\Annotation\AnnotationBuilder
    ;

class ImportController extends AbstractActionController
{
    public function countryAction()
    {
        $modelCountry = $this->getServiceLocator()->get('modelCountry');

        $countries = include __DIR__ . '/../../../data/countries.php';

        foreach ($countries as $name => $code) {
            $country = new CountryEntity;

            $country->setName($name);
            $country->setAbbrev($code);

            $modelCountry->create($country);
        }

        return $this->plugin('redirect')->toUrl('/country');
    }

    public function stateAction()
    {
        $modelCountry = $this->getServiceLocator()->get('modelCountry');
        $modelState = $this->getServiceLocator()->get('modelState');

        $country = $modelCountry->findOneBy(array(
                     'abbrev' => 'US'
                 ));

        $states = include(__DIR__ . '/../../../data/us_states.php');

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

        $states = include(__DIR__ . '/../../../data/ca_states.php');

        foreach ($states as $code => $name) {
            $state = new StateEntity;

            $state->setName($name);
            $state->setAbbrev($code);
            $state->setCountry($country);

            $modelState->create($state);
        }

        return $this->plugin('redirect')->toUrl('/state?countryId=' . $country->getId());
    }

    public function placeAction()
    {
        $modelCountry = $this->getServiceLocator()->get('modelCountry');
        $modelState = $this->getServiceLocator()->get('modelState');
        $modelPlace = $this->getServiceLocator()->get('modelPlace');
        $db = $this->getServiceLocator()->get('db');

        $statement = $db->query('select distinct city, state from shows');
        $results = $statement->execute();

        foreach ($results as $row) {
            if (!$states = $modelState->findBy(array(
                'name' => $row['state']
            ))) {
                $states = $modelState->findBy(array(
                    'abbrev' => $row['state']
                ));
            }

            if ($states and sizeof($states) == 1) {
                $place = new PlaceEntity;

                $place->setState($states[0]);
                $place->setName($row['city']);

                $modelPlace->create($place);
            } else {
                $countries = $modelCountry->findBy(array(
                    'name' => $row['state']
                ));

                if (!$countries) {
                    $countries = $modelCountry->findBy(array(
                        'abbrev' => $row['state']
                    ));
                }

                // Found a country
                if ($countries and sizeof($countries) == 1) {
                    // Does a state for the country exist?
                    if ($state = $modelState->findOneBy(array(
                        'name' => $countries[0]->getName()
                    ))) {
                        $state = $modelState->findOneBy(array(
                            'abbrev' => $countries[0]->getAbbrev()
                        ));
                    } else {

                        $state = new StateEntity;
                        $state->setCountry($countries[0]);
                        $state->setName($countries[0]->getName());
                        $state->setAbbrev($countries[0]->getAbbrev());

                        $modelState->create($state);
                    }

                    $place = new PlaceEntity;

                    $place->setState($state);
                    $place->setName($row['city']);

                    $modelPlace->create($place);
                } else {
                    echo "Not imported: " . $row['city'] . ' - ' . $row['state'] . '<BR>';
                }
            }

        }

        die('places import');
    }
}
