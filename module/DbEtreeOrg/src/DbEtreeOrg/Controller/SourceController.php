<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Db\Entity\Source as SourceEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Workspace\Service\WorkspaceService as Workspace;

class SourceController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $sources = Workspace::filter($em->getRepository('Db\Entity\Source')->findBy(array(), array('id' => 'desc'), 30));

        return array(
            'sources' => $sources,
        );
    }

    public function bandAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $bandId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        $year = (int)$this->getEvent()->getRouteMatch()->getParam('year');

        $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($bandId));
        if (!$bandId or !$band) {
            return $this->plugin('redirect')->toRoute('default', array(
                'controller' => 'source',
                'action' => 'index',
            ));
        }

        // Is the year valid?
        if ($year < 1877 or $year > date('Y')) $year = 0;

        if (!$year) $year = $em->getRepository('Db\Entity\Band')->getLatestYear($band);
        $sources = Workspace::filter($em->getRepository('Db\Entity\Source')->findByBandYear($band, $year));
        $years = $em->getRepository('Db\Entity\Source')->findAllYearsByBand($band);

        return array(
            'band' => $band,
            'year' => $year,
            'years' => $years,
            'sources' => $sources,
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id)
            return $this->plugin('redirect')->toUrl('/source');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $source = Workspace::filter($em->getRepository('Db\Entity\Source')->find($id));

        if (!$source)
            throw new \Exception("Source $id not found");

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('sources', $source->getId());

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
        $performance = Workspace::filter($em->getRepository('Db\Entity\Performance')->find($id));

        if (!$performance)
            throw new \Exception("Performance $id not found");

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($source->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $source->exchangeArray($form->getData());
                $source->setPerformance($performance);

                $em->persist($source);
                $em->flush();

                return $this->plugin('redirect')->toUrl('/source/detail/' . $source->getId());
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

        $id = (int)$this->getRequest()->getQuery()->get('id');
        $source = Workspace::filter($em->getRepository('Db\Entity\Source')->find($id));

        if (!$source)
            throw new \Exception("Source $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($source);
        $form->setData($source->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($source->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $source->exchangeArray($form->getData());

                $em->persist($source);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('source', $source);
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
