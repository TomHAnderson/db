<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\Venue as VenueEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class VenueController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venues = Workspace::filter($em->getRepository('Db\Entity\Venue')->findBy(array(), array('name' => 'ASC')));

        return array(
            'venues' => $venues,
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('venueId');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venue = Workspace::filter($em->getRepository('Db\Entity\Venue')->find($id));

        if (!$venue)
            throw new \Exception("Venue $id not found");

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('venues', $venue->getId());

        return array(
            'venue' => $venue
        );
    }

    public function createAction()
    {
        $venue = new VenueEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($venue);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($venue->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $venue->exchangeArray($form->getData());

                # $venue->setPlace($place);

                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

                $em->persist($venue);
                $em->persist($venueGroup);

                // end collection testing
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('venues', $venue->getId());

                die(); // all ok
            }
        }

        $country = $form->get('country');
        $countries = include(__DIR__ . '/../../../../../vendor/umpirsky/country-list/country/cldr/en_US/country.php');
        $country->setValueOptions($countries);
        $country->setValue('US');

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('venueId');
        $venue = Workspace::filter($em->getRepository('Db\Entity\Venue')->find($id));

        if (!$venue)
            throw new \Exception("Venue $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($venue);
        $form->setData($venue->getArrayCopy());

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('venues', $venue->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($venue->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $venue->exchangeArray($form->getData());

                $em->persist($venue);
                $em->flush();

                die();
            }
        }

        $country = $form->get('country');
        $countries = include(__DIR__ . '/../../../../../vendor/umpirsky/country-list/country/cldr/en_US/country.php');
        $country->setValueOptions($countries);

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('venue', $venue);
        return $viewModel;
    }

    public function deleteAction()
    {
    }

    public function searchJsonAction()
    {
        $query = $this->getRequest()->getQuery()->get('q');

        $filterNormalize = new Normalize();

        $query = $filterNormalize(trim($query));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $venues = Workspace::filter($em->getRepository('Db\Entity\Venue')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20));

        $return = array();
        $i = 0;
        foreach ($venues as $venue) {
            if (++$i > 25) break;
            $return[] = $venue->getArrayCopy();
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('venues', $return);

        return $jsonModel;
    }
}
