<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Db\Entity\Song as SongEntity;
use Zend\Form\Annotation\AnnotationBuilder;
use Db\Filter\Normalize;
use Zend\View\Model\JsonModel;
use Workspace\Service\WorkspaceService as Workspace;

class SongController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $songs = Workspace::filter($em->getRepository('Db\Entity\Song')->findBy(array(), array('name' => 'ASC')));

        return array(
            'songs' => $songs,
        );
    }

    public function detailAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('songId');
        $song = Workspace::filter($em->getRepository('Db\Entity\Song')->find($id));
        if (!$song)
            return $this->plugin('redirect')->toRoute('home');

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('songs', $song->getId());

        return array(
            'song' => $song
        );
    }

    public function createAction()
    {
        $song = new SongEntity();
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($song);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($song->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $song->exchangeArray($form->getData());
                $bandId = $this->getRequest()->getPost()->get('band_id');
                if ($bandId) {
                    $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($bandId));
                    $song->setBand($band);
                }

                $em->persist($song);
                $em->flush();

                $menu = $this->getServiceLocator()->get('menu');
                $menu->addRecent('songs', $song->getId());

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        return $viewModel;
    }

    public function editAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('songId');
        $song = Workspace::filter($em->getRepository('Db\Entity\Song')->find($id));

        if (!$song)
            throw new \Exception("Performance Set $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($song);
        $form->setData($song->getArrayCopy());

        $this->getServiceLocator()->get('menu')->addRecent('songs', $song->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($song->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $song->exchangeArray($form->getData());
                $bandId = $this->getRequest()->getPost()->get('band_id');
                if ($bandId) {
                    $band = Workspace::filter($em->getRepository('Db\Entity\Band')->find($bandId));
                    $song->setBand($band);
                }

                $em->persist($song);
                $em->flush();

                die();
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('song', $song);
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

        $songs = Workspace::filter($em->getRepository('Db\Entity\Song')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20));

        $return = array();
        $i = 0;
        foreach ($songs as $song) {
            if (++$i > 25) break;
            $return[] = $song->getArrayCopy();
        }

        $jsonModel = new JsonModel;
        $jsonModel->setVariable('songs', $return);

        return $jsonModel;
    }
}
