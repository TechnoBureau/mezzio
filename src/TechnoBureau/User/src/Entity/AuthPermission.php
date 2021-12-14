<?php

namespace TechnoBureau\User\Entity;

/**
 * AuthPermission
 */
class AuthPermission
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $contentTypeId;

    /**
     * @var string
     */
    private $codename;

    /**
     * @var int
     */
    private $id;


    /**
     * Set name.
     *
     * @param string $name
     *
     * @return AuthPermission
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set contentTypeId.
     *
     * @param int $contentTypeId
     *
     * @return AuthPermission
     */
    public function setContentTypeId($contentTypeId)
    {
        $this->contentTypeId = $contentTypeId;

        return $this;
    }

    /**
     * Get contentTypeId.
     *
     * @return int
     */
    public function getContentTypeId()
    {
        return $this->contentTypeId;
    }

    /**
     * Set codename.
     *
     * @param string $codename
     *
     * @return AuthPermission
     */
    public function setCodename($codename)
    {
        $this->codename = $codename;

        return $this;
    }

    /**
     * Get codename.
     *
     * @return string
     */
    public function getCodename()
    {
        return $this->codename;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
