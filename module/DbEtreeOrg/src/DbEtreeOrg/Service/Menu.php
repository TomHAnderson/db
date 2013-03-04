<?php

namespace DbEtreeOrg\Service;
use Zend\ServiceManager\ServiceManager
    , Db\Entity\UserMeta as UserMetaEntity
    ;

class Menu {
    use \Db\Component\ServiceManager
        ;

    public function __construct(ServiceManager $serviceManager) {
        $this->setServiceManager($serviceManager);
    }

    public function addRecent($section, $id, $limit = 10)
    {
        $em = $this->getServiceManager()->get('doctrine.entitymanager.orm_default');
        $auth = $this->getServiceManager()->get('zfcuser_auth_service');

        if (!$auth->hasIdentity()) return array();
        $user = $auth->getIdentity();

        // Get meta entity
        $meta = $em->getRepository('Db\Entity\UserMeta')->findOneBy(array(
            'user' => $user,
            'name' => 'Menu'
        ));
        if (!$meta) {
            $meta = new UserMetaEntity;
            $meta->setUser($user);
            $meta->setName('Menu');
        }
        $content = unserialize($meta->getContent());

        // Add new key to content array
        if (!isset($content[$section])) $content[$section] = array();
        if (in_array($id, $content[$section])) {
            unset($content[$section][array_search($id, $content[$section])]);
        }
        array_unshift($content[$section], $id);
        $content[$section] = array_slice($content[$section], 0, $limit);

        $meta->setContent(serialize($content));

        $em->persist($meta);
        $em->flush();

        return true;
    }

    public function getRecent()
    {
        $em = $this->getServiceManager()->get('doctrine.entitymanager.orm_default');
        $auth = $this->getServiceManager()->get('zfcuser_auth_service');

        if (!$auth->hasIdentity()) return array();
        $user = $auth->getIdentity();

        // Get meta entity
        $meta = $em->getRepository('Db\Entity\UserMeta')->findOneBy(array(
            'user' => $user,
            'name' => 'Menu'
        ));
        if (!$meta) return array();

        return unserialize($meta->getContent());
    }

    public function removeRecent($section, $id)
    {
        $em = $this->getServiceManager()->get('doctrine.entitymanager.orm_default');
        $auth = $this->getServiceManager()->get('zfcuser_auth_service');

        if (!$auth->hasIdentity()) return array();
        $user = $auth->getIdentity();

        // Get meta entity
        $meta = $em->getRepository('Db\Entity\UserMeta')->findOneBy(array(
            'user' => $user,
            'name' => 'Menu'
        ));
        if (!$meta) return;

        $content = unserialize($meta->getContent());

        if (isset($content[$section])) {
            unset($content[$section][array_search($id, $content[$section])]);
        }

        $meta->setContent(serialize($content));
        $em->persist($meta);
        $em->flush();

        return true;
    }
}