<?php

namespace TechnoBureau\User\Entity;

/**
 * AuthUserGroups
 */
class AuthUserGroups
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \TechnoBureau\User\Entity\AuthGroup
     */
    private $group;

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
     * Set group.
     *
     * @param \TechnoBureau\User\Entity\AuthGroup|null $group
     *
     * @return AuthUserGroups
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

    /**
     * Set user.
     *
     * @param \TechnoBureau\User\Entity\AuthUser|null $user
     *
     * @return AuthUserGroups
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
