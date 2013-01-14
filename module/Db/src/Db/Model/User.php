<?php

namespace Db\Model;

use Db\Model\AbstractModel;
use Db\Entity\User as UserEntity;
use Zend\InputFilter\InputFilter;

class User extends AbstractModel
{
    use \Db\Field\DisplayName
        , \Db\Field\Username
        ;

    public function getDefaultSort()
    {
        return array('displayName' => 'asc');
    }

    public function find($id)
    {
        return $this->getEm()->getRepository('Db\Entity\User')->find($id);
    }

    public function findOneBy($params)
    {
        return $this->getEm()->getRepository('Db\Entity\User')->findOneBy($params);
    }

    public function findAll($sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();
        return $this->getEm()->getRepository('Db\Entity\User')->findBy(array(), $sort);
    }

    public function findBy($search, $sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();
        return $this->getEm()->getRepository('Db\Entity\User')->findBy($search, $sort);
    }

    public function findLike($search, $sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();

        $query = $this->getEm()->getRepository("Db\Entity\User")->createQueryBuilder('s');
        $i = 0;
        foreach ($search as $column => $value) {
            $paramName = md5(uniqid());
            $query->andWhere('s.' . $column . ' LIKE ?' . ++$i);
            $query->setParameter($i, $value);
        }

        foreach ($sort as $column => $direction) {
            $query->add('orderBy', "s.$column $direction");
        }

        $query = $query->getQuery();

       return $query->getResult();
    }

    public function create(UserEntity $user)
    {
        $this->getEm()->persist($user);
        $this->getEm()->flush();
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user));

        return $user;
    }

    public function edit(UserEntity $user)
    {
        $this->getEm()->flush();
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user));

        return $user;
    }

    public function delete(UserEntity $user)
    {
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user));
        $this->getEm()->remove($user);
        $this->getEm()->flush();

        return $user;
    }

    public function getAuthUser()
    {
        $auth = $this->getServiceManager()->get('Zend\Authentication\AuthenticationService');

        $user = null;

        if ($auth->hasIdentity()) {
            $user = $this->find($auth->getIdentity());
        }

        return $user;
    }

    public function getInputFilter($entity = null)
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputDisplayName());
        $inputFilter->add($this->inputFilterInputUsername());

        return $inputFilter;
    }
}