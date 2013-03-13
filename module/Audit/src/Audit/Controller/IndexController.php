<?php

namespace Audit\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use SimpleThings\EntityAudit\Utils\ArrayDiff;
use Doctrine\ORM\Mapping\ClassMetadata;

class IndexController extends AbstractActionController {

    private $iconMap = array(
        'Db\Entity\Performer' => 'icon-film',
        'Db\Entity\PerformerAlias' => 'icon-github-alt',
        'Db\Entity\Performance'  => 'icon-magic',
        'Db\Entity\PerformanceSet' => 'icon-certificate',
        'Db\Entity\Venue' => 'icon-map-marker',
        'Db\Entity\VenueGroup' => 'icon-folder-close',
        'Db\Entity\Event' => 'icon-folder-close',
        'Db\Entity\Producer' => 'icon-folder-close',
        'Db\Entity\Lineup' => 'icon-group',
        'Db\Entity\Band' => 'icon-cogs',
        'Db\Entity\BandGroup' => 'icon-folder-close',
        'Db\Entity\Alias' => 'icon-folder-close',
        'Db\Entity\Source' => 'icon-headphones',
        'Db\Entity\Checksum' => 'icon-ok-circle',
        'Db\Entity\PerformanceSetSong' => 'icon-bolt',
        'Db\Entity\Song' => 'icon-music',
        'Db\Entity\AbstractComment' => 'icon-folder-close',
        'Db\Entity\AbstractLink' => 'icon-folder-close',
        'Db\Entity\PerformerLineup' => 'icon-group',
        'Db\Entity\PerformerPerformance' => 'icon-facetime-video',
        'Db\Entity\BandAlias' => 'icon-facetime-video',
    );

    private $routeMap = array(
        'Db\Entity\Performer' => 'performer',
        'Db\Entity\PerformerAlias' => 'performer-alias',
        'Db\Entity\Performance'  => 'performance',
        'Db\Entity\PerformanceSet' => 'performance-set',
        'Db\Entity\Venue' => 'venue',
        'Db\Entity\VenueGroup' => 'venue-group',
        'Db\Entity\Event' => 'event',
        'Db\Entity\Producer' => 'producer',
        'Db\Entity\Lineup' => 'lineup',
        'Db\Entity\Band' => 'band',
        'Db\Entity\BandGroup' => 'band-group',
        'Db\Entity\Alias' => 'alias',
        'Db\Entity\Source' => 'source',
        'Db\Entity\Checksum' => 'checksum',
        'Db\Entity\PerformanceSetSong' => 'performance-set-song',
        'Db\Entity\Song' => 'song',
        'Db\Entity\AbstractComment' => '',
        'Db\Entity\AbstractLink' => '',
        'Db\Entity\PerformerLineup' => 'performer-lineup',
        'Db\Entity\PerformerPerformance' => 'performer-lineup',
        'Db\Entity\BandAlias' => 'band-alias',
    );

    private function getIconMap() {
        return $this->iconMap;
    }

    private function getRouteMap() {
        return $this->routeMap;
    }

    /**
     * Renders a paginated list of revisions.
     *
     * @param int $page
     * @return  \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $sm = $this->getServiceLocator() ;
        $auditReader = $sm->get('auditReader');
        $config = $sm->get("Config");
        $auditConfig = $config["audit"];
        $page = (int)$this->getEvent()->getRouteMatch()->getParam('page');
        $revisions = $auditReader->findRevisionHistory($auditConfig['ui']['page.limit'], 20 * ($page - 1));

        return new ViewModel(array(
            'revisions' => $revisions,
            'auditReader' => $auditReader,
            'iconMap' => $this->getIconMap(),
            'routeMap' => $this->getRouteMap(),
        ));
    }

    /**
     * Shows entities changed in the specified revision.
     *
     * @param integer $rev
     * @return \Zend\View\Model\ViewModel
     *
     */
    public function viewRevisionAction() {
        $rev = (int) $this->getEvent()->getRouteMatch()->getParam('rev');
        $revision = $this->getServiceLocator()->get('auditReader')->findRevision($rev);
        if (!$revision) {
            throw new \Exception(sprintf('Revision %i not found', $rev));
        }
        $changedEntities = $this->getServiceLocator()->get('auditReader')->findEntitesChangedAtRevision($rev);

        return new ViewModel(array(
            'revision' => $revision,
            'changedEntities' => $changedEntities,
            'iconMap' => $this->getIconMap(),
            'routeMap' => $this->getRouteMap(),
        ));
    }

    /**
     * Lists revisions for the supplied entity.
     *
     * @param string $className
     * @param string $id
     * @return \Zend\View\Model\ViewModel
     */
    public function viewEntityAction() {
        $className = $this->getEvent()->getRouteMatch()->getParam('className');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $ids = explode(',', $id);
        $revisions = $this->getServiceLocator()->get('auditReader')->findRevisions($className, $ids);

        return new ViewModel(array(
            'id' => $id,
            'className' => $className,
            'revisions' => $revisions,
            'iconMap' => $this->getIconMap(),
            'routeMap' => $this->getRouteMap(),
        ));
    }

    /**
     * Shows the data for an entity at the specified revision.
     *
     * @param string $className
     * @param string $id Comma separated list of identifiers
     * @param int $rev
     * @return \Zend\View\Model\ViewModel
     */
    public function viewdetailAction() {
        $className = $this->getEvent()->getRouteMatch()->getParam('className');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $rev = $this->getEvent()->getRouteMatch()->getParam('rev');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $metadata = $em->getClassMetadata($className);

        $ids = explode(',', $id);
        $entity = $this->getServiceLocator()->get('auditReader')->find($className, $ids, $rev);

        $data = $this->getEntityValues($metadata, $entity);
        krsort($data);

        return new ViewModel(array(
            'id' => $id,
            'rev' => $rev,
            'className' => $className,
            'entity' => $entity,
            'data' => $data,
            'iconMap' => $this->getIconMap(),
            'routeMap' => $this->getRouteMap(),
        ));
    }

    /**
     * Compares an entity at 2 different revisions.
     *
     *
     * @param string $className
     * @param string $id Comma separated list of identifiers
     * @param null|int $oldRev if null, pulled from the posted data
     * @param null|int $newRev if null, pulled from the posted data
     * @return Response
     */
    public function compareAction() {
        $className = $this->getEvent()->getRouteMatch()->getParam('className');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $oldRev = $this->getEvent()->getRouteMatch()->getParam('oldRev');
        $newRev = $this->getEvent()->getRouteMatch()->getParam('newRev');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $metadata = $em->getClassMetadata($className);
        $posted_data = $this->params()->fromPost();
        if (null === $oldRev) {
            $oldRev = (int)$posted_data['oldRev'];
        }

        if (null === $newRev) {
            $newRev = (int)$posted_data["newRev"];
        }
        $ids = explode(',', $id);
        $oldEntity = $this->getServiceLocator()->get('auditReader')->find($className, $ids, $oldRev);
        $oldData = $this->getEntityValues($metadata, $oldEntity);

        $newEntity = $this->getServiceLocator()->get('auditReader')->find($className, $ids, $newRev);
        $newData = $this->getEntityValues($metadata, $newEntity);

        $differ = new ArrayDiff();
        $diff = $differ->diff($oldData, $newData);

        return new ViewModel(array(
            'className' => $className,
            'id' => $id,
            'oldRev' => $oldRev,
            'newRev' => $newRev,
            'diff' => $diff,
            'iconMap' => $this->getIconMap(),
            'routeMap' => $this->getRouteMap(),
        ));
    }

    protected function getEntityValues(ClassMetadata $metadata, $entity) {
        $fields = $metadata->getFieldNames();

        $return = array();
        foreach ($fields AS $fieldName) {
            $return[$fieldName] = $metadata->getFieldValue($entity, $fieldName);
        }

        return $return;
    }
}

