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

use Db\Entity\Country as CountryEntity;

use Zend\Form\Annotation\AnnotationBuilder;

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
}
