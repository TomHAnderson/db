<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\PerformanceSetSong as PerformanceSetSongEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class PerformanceSetSongController extends AbstractActionController
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
            return $this->plugin('redirect')->toUrl('/');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $performanceSetSong = $em->getRepository('Db\Entity\PerformanceSetSong')->find($id);

        if (!$performanceSetSong)
            throw new \Exception("Performance Set Song $id not found");

        return array(
            'performanceSetSong' => $performanceSetSong
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $performanceSetSong = new PerformanceSetSongEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($performanceSetSong);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performanceSet = $em->getRepository('Db\Entity\PerformanceSet')->find($id);

        $song = null;

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($performanceSetSong->getInputFilter());

            $songId = $this->getRequest()->getPost()->get('song_id');
            if ($songId) $song = $em->getRepository('Db\Entity\Song')->find($songId);

            if ($song and $form->isValid()) {
                $data = $form->getData();
                $performanceSetSong->exchangeArray($form->getData());
                $performanceSetSong->setPerformanceSet($performanceSet);
                $performanceSetSong->setSong($song);
                $performanceSetSong->setSort(99999);

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
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performanceSetSong = $em->getRepository('Db\Entity\PerformanceSetSong')->find($id);

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
                $song = $em->getRepository('Db\Entity\Song')->find($songId);
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
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $performanceSetSong = $em->getRepository('Db\Entity\PerformanceSetSong')->find($id);

        if (!$performanceSetSong)
            return $this->plugin('redirect')->toUrl('/');

        $performanceSetId = $performanceSetSong->getPerformanceSet()->getId();
        $em->remove($performanceSetSong);
        $em->flush();

        return $this->plugin('redirect')->toUrl('/performance-set/detail?id=' . $performanceSetId);
    }
}
