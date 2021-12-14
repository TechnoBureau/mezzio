<?php

namespace TechnoBureau\User\Entity;

/**
 * AuthGroupPermissions
 */
class AuthGroupPermissions
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \TechnoBureau\User\Entity\AuthPermission
     */
    private $permission;

    /**
     * @var \TechnoBureau\User\Entity\AuthGroup
     */
    private $group;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set permission.
     *
     * @param \TechnoBureau\User\Entity\AuthPermission|null $permission
     *
     * @return AuthGroupPermissions
     */
    public function setPermission(\TechnoBureau\User\Entity\AuthPermission $permission = null)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission.
     *
     * @return \TechnoBureau\User\Entity\AuthPermission|null
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set group.
     *
     * @param \TechnoBureau\User\Entity\AuthGroup|null $group
     *
     * @return AuthGroupPermissions
     */
    public function setGroup(\TechnoBureau\User\Entity\AuthGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group.
     *
     * @return \TechnoBureau\User\Entity\AuthGroup|null
     */
    public function getGroup()
    {
        return $this->group;
    }
}
