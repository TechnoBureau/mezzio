<?php

namespace TechnoBureau\User\Entity;

/**
 * AuthUserUserPermissions
 */
class AuthUserUserPermissions
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
     * @var \TechnoBureau\User\Entity\AuthUser
     */
    private $user;


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
     * @return AuthUserUserPermissions
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
     * Set user.
     *
     * @param \TechnoBureau\User\Entity\AuthUser|null $user
     *
     * @return AuthUserUserPermissions
     */
    public function setUser(\TechnoBureau\User\Entity\AuthUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \TechnoBureau\User\Entity\AuthUser|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
