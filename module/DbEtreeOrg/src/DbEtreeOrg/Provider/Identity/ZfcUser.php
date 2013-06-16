<?php

namespace DbEtreeOrg\Provider\Identity;

use BjyAuthorize\Exception\InvalidRoleException;
use BjyAuthorize\Provider\Identity\ProviderInterface;
use Zend\Permissions\Acl\Role\RoleInterface;
use Zend\Authentication\AuthenticationService;

class ZfcUser implements ProviderInterface
{
    protected $authenticationService;
    protected $defaultRole;

    /**
     * @param \Zend\Db\Adapter\Adapter $adapter
     * @param \ZfcUser\Service\User    $userService
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->setAuthenticationService($authenticationService);
        $this->setDefaultRole('guest');
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentityRoles()
    {
        $authService = $this->getAuthenticationService();

        if (!$authService->hasIdentity()) {
            return array($this->getDefaultRole());
        }

            return array($this->getDefaultRole(), 'user');

        $roles = array($this->getDefaultRole());
        foreach ($authService->getIdentity()->getPermission() as $group) {
            if ($group->getRole()) $roles[] = $group->getRole();
        }

        return $roles;
    }

    /**
     * @return string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    public function getDefaultRole()
    {
        return $this->defaultRole;
    }

    /**
     * @param string|\Zend\Permissions\Acl\Role\RoleInterface $defaultRole
     *
     * @throws \BjyAuthorize\Exception\InvalidRoleException
     */
    public function setDefaultRole($defaultRole)
    {
        if ( ! ($defaultRole instanceof RoleInterface || is_string($defaultRole))) {
            throw InvalidRoleException::invalidRoleInstance($defaultRole);
        }

        $this->defaultRole = $defaultRole;
    }

    public function setAuthenticationService(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;

        return $this;
    }

    public function getAuthenticationService()
    {
        return $this->authenticationService;
    }
}
