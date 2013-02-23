<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Source as SourceEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class SourceController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/source');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $source = $em->getRepository('Db\Entity\Source')->find($id);

        if (!$source)
            throw new \Exception("Source $id not found");

        if (!isset($_SESSION['sources']['latest'])) $_SESSION['sources']['latest'] = array();
        if (in_array($source->getId(), $_SESSION['sources']['latest'])) {
            unset($_SESSION['sources']['latest'][array_search($source->getId(), $_SESSION['sources']['latest'])]);
        }
        array_unshift($_SESSION['sources']['latest'], $source->getId());
        $_SESSION['sources']['latest'] = array_slice($_SESSION['sources']['latest'], 0, 10);

        return array(
            'source' => $source
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $source = new SourceEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($source);

        $id = $this->getRequest()->getQuery()->get('id');
        $performance = $em->getRepository('Db\Entity\Performance')->find($id);

        if (!$performance)
            throw new \Exception("Performance $id not found");

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performance->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performance->exchangeArray($form->getData());

                # $venue->setPlace($place);

                $em->persist($performance);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/performance/detail?id=' . $performance->getId());
            }
        }

        return array(
            'form' => $form,
            'performance' => $performance,
        );
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
