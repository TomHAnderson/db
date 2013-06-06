<?php

namespace DbEtreeOrg\Controller;
use Zend\Mvc\Controller\AbstractActionController
    , Zend\View\Model\ViewModel
    , Db\Entity\Song as SongEntity
    , Zend\Form\Annotation\AnnotationBuilder
    , Db\Filter\Normalize
    , Zend\View\Model\JsonModel
    ;

class SongController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $songs = $em->getRepository('Db\Entity\Song')->findBy(array(), array('name' => 'ASC'));

        return array(
            'songs' => $songs,
        );
    }

    public function detailAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        $song = $em->getRepository('Db\Entity\Song')->find($id);
        if (!$song)
            return $this->plugin('redirect')->toUrl('/');

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('songs', $song->getId());

        return array(
            'song' => $song
        );
    }

    public function createAction()
    {
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

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
                    $band = $em->getRepository('Db\Entity\Band')->find($bandId);
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
        if (!$this->getServiceLocator()->get('zfcuser_auth_service')->hasIdentity())
            return $this->plugin('redirect')->toUrl('/user/login');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->getRequest()->getQuery()->get('id');
        $song = $em->getRepository('Db\Entity\Song')->find($id);

        if (!$song)
            throw new \Exception("Performance Set $id not found");

        $builder = new AnnotationBuilder();
        $form = $builder->createForm($song);
        $form->setData($song->getArrayCopy());

        $menu = $this->getServiceLocator()->get('menu');
        $menu->addRecent('songs', $song->getId());

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            $form->setUseInputFilterDefaults(false);
            $form->setInputFilter($song->getInputFilter());

            if ($form->isValid()) {
                $data = $form->getData();
                $song->exchangeArray($form->getData());
                $bandId = $this->getRequest()->getPost()->get('band_id');
                if ($bandId) {
                    $band = $em->getRepository('Db\Entity\Band')->find($bandId);
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

            $menu = $this->getServiceLocator()->get('menu');
            $menu->removeRecent('songs', $song->getId());

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

        $songs = $em->getRepository('Db\Entity\Song')->findLike(array(
            'nameNormalize' => '%' . $query . '%',
        ), array(), 20);

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
