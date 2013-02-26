<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Venue as VenueEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class VenueController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = $this->getRequest()->getQuery()->get('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/venue');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $venue = $em->getRepository('Db\Entity\Venue')->find($id);

        if (!$venue)
            throw new \Exception("Venue $id not found");

        if (!isset($_SESSION['venues']['latest'])) $_SESSION['venues']['latest'] = array();
        if (in_array($venue->getId(), $_SESSION['venues']['latest'])) {
            unset($_SESSION['venues']['latest'][array_search($venue->getId(), $_SESSION['venues']['latest'])]);
        }
        array_unshift($_SESSION['venues']['latest'], $venue->getId());
        $_SESSION['venues']['latest'] = array_slice($_SESSION['venues']['latest'], 0, 10);

        return array(
            'venue' => $venue
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

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
                $em->flush();

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
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $venue = $em->getRepository('Db\Entity\Venue')->find($id);

        if (!$venue)
            throw new \Exception("Venue $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($venue);
        $form->setData($venue->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($venue->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $venue->exchangeArray($form->getData());

                $em->persist($venue);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/venue/detail?id=' . $venue->getId());
            }
        }

        $country = $form->get('country');
        $countries = include(__DIR__ . '/../../../../../vendor/umpirsky/country-list/country/cldr/en_US/country.php');
        $country->setValueOptions($countries);

        return array(
            'form' => $form,
            'venue' => $venue,
        );
    }

    public function deleteAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $venue = $em->getRepository('Db\Entity\Venue')->find($id);
        if (!$venue)
            return $this->plugin('redirect')->toUrl('/');

        if (!sizeof($venue->getPerformances())
            and !sizeof($venue->getVenueGroups())
            and !sizeof($venue->getLinks())
            and !sizeof($venue->getComments()))
        {
            $em->remove($venue);
            $em->flush();
        }

        return $this->plugin('redirect')->toUrl('/');
    }

    public function searchJsonAction()
    {
        $query = $this->getRequest()->getQuery()->get('q');

        $filterNormalize = new Normalize();

        $query = $filterNormalize(trim($query));

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $venues = $em->getRepository('Db\Entity\Venue')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20);

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
