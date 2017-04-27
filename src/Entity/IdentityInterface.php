<?php

namespace Breeze\Acl\Entity;

use Zend\Permissions\Acl\Role\RoleInterface;

/**
 * Interface IdentityInterface
 */
interface IdentityInterface
{
    /**
     * @return RoleInterface[]
     */
    public function getRoles(): array;
}
