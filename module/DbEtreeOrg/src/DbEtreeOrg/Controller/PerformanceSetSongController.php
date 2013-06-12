<?php

namespace DbEtreeOrg\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\PerformanceSetSong as PerformanceSetSongEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class PerformanceSetSongController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
        );
    }

    public function detailAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceSetSongId');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performanceSetSong = Workspace::filter($em->getRepository('Db\Entity\PerformanceSetSong')->find($id));

        if (!$performanceSetSong)
            throw new \Exception("Performance Set Song $id not found");

        return array(
            'performanceSetSong' => $performanceSetSong
        );
    }

    public function createAction()
    {
        $performanceSetSong = new PerformanceSetSongEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performanceSetSong);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceSetId');
        $performanceSet = Workspace::filter($em->getRepository('Db\Entity\PerformanceSet')->find($id));

        $song = null;

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSetSong->getInputFilter());

            $songId = $this->getRequest()->getPost()->get('song_id');
            if ($songId) $song = Workspace::filter($em->getRepository('Db\Entity\Song')->find($songId));

            if ($song and $form->isValid()) {
                $data = $form->getData();
                $performanceSetSong->exchangeArray($form->getData());
                $performanceSetSong->setPerformanceSet($performanceSet);
                $performanceSetSong->setSong($song);

                $em->persist($performanceSetSong);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('performanceSet', $performanceSet);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceSetSongId');
        $performanceSetSong = Workspace::filter($em->getRepository('Db\Entity\PerformanceSetSong')->find($id));

        if (!$performanceSetSong)
            throw new \Exception("Performance Song $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performanceSetSong);
        $form->setData($performanceSetSong->getArrayCopy());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSetSong->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $performanceSetSong->exchangeArray($form->getData());

                $songId = $this->getRequest()->getPost()->get('song_id');
                $song = Workspace::filter($em->getRepository('Db\Entity\Song')->find($songId));
                $performanceSetSong->setSong($song);

                $em->persist($song);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('id', $id);
        $viewModel->setVariable('performanceSetSong', $performanceSetSong);
        return $viewModel;
    }

    public function deleteAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('performanceSetSongId');
        $performanceSetSong = Workspace::filter($em->getRepository('Db\Entity\PerformanceSetSong')->find($id));

        if (!$performanceSetSong)
            return $this->plugin('redirect')->toRoute('home');

        $performanceId = $performanceSetSong->getPerformanceSet()->getPerformance()->getId();
        $em->remove($performanceSetSong);
        $em->flush();

        return $this->plugin('redirect')->toRoute('performance/detail', array(
            'id' => $performanceId
        ));
    }
}
