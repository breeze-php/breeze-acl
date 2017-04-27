<?php

namespace Breeze\Acl\Entity;

use Zend\Permissions\Acl\Acl;

/**
 * Class AclProtectedTrait
 */
trait AclProtectedTrait
{
    /**
     * @var Acl
     * */
    private $acl;

    /**
     * @var IdentityInterface
     */
    private $identity;

    /**
     * Allow code to disable ACL when needed
     *
     * @var bool
     */
    private $locked = true;

    /**
     * @param Acl $acl
     */
    public function setAcl(Acl $acl)
    {
        $this->acl = $acl;
    }

    /**
     * @param IdentityInterface $identity
     */
    public function setIdentity(IdentityInterface $identity)
    {
        $this->identity = $identity;
    }

    /**
     * @param string $resource
     * @param string $privilege
     * @return bool
     */
    public function isAllowed(string $resource, string $privilege): bool
    {
        if ($this->locked && $this->identity && $this->acl) {
            foreach ($this->identity->getRoles() as $role) {
                if ($this->acl->isAllowed($role, $resource, $privilege)) {
                    return true;
                }
            }
        }

        return !$this->locked;
    }

    public function lock()
    {
        $this->locked = true;
    }

    public function unlock()
    {
        $this->locked = false;
    }
}
