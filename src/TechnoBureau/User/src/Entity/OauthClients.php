<?php
declare(strict_types=1);

namespace TechnoBureau\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\ClientEntityInterface as OAuthClientInterface;
use Mezzio\Authentication\UserInterface as MezzioUserInterface;

/**
 * OauthClients
 */
class OauthClients implements MezzioUserInterface, OAuthClientInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $secret;

    /**
     * @var string
     */
    private $redirect;

    /**
     * @var bool
     */
    private $isrevoked = '';

    /**
     * @var bool
     */
    private $isconfidential = '';

    /**
     * @var int
     */
    private $id;

    /**
     * @var \TechnoBureau\User\Entity\AuthUser
     */
    private $user;

    private array $roles = [];
    private array $details = [];

    public function __construct()
    {
        $this->id = 0;
        $this->name = '';
        $this->secret = null;
        $this->redirect = '';
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return OauthClients
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
     * Set secret.
     *
     * @param string|null $secret
     *
     * @return OauthClients
     */
    public function setSecret($secret = null)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret.
     *
     * @return string|null
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set redirect.
     *
     * @param string $redirect
     *
     * @return OauthClients
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Get redirect.
     *
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set isrevoked.
     *
     * @param bool $isrevoked
     *
     * @return OauthClients
     */
    public function setIsrevoked($isrevoked)
    {
        $this->isrevoked = $isrevoked;

        return $this;
    }

    /**
     * Get isrevoked.
     *
     * @return bool
     */
    public function getIsrevoked()
    {
        return $this->isrevoked;
    }

    /**
     * Set isconfidential.
     *
     * @param bool $isconfidential
     *
     * @return OauthClients
     */
    public function setIsconfidential($isconfidential)
    {
        $this->isconfidential = $isconfidential;

        return $this;
    }

    /**
     * Get isconfidential.
     *
     * @return bool
     */
    public function getIsconfidential()
    {
        return $this->isconfidential;
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

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Set user.
     *
     * @param \TechnoBureau\User\Entity\AuthUser|null $user
     *
     * @return OauthClients
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

    public function getIdentity(): string
    {
        return $this->getName();
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setDetails(array $details): self
    {
        $this->details = $details;
        return $this;
    }

    /** @psalm-suppress MixedReturnTypeCoercion */
    public function getDetails(): array
    {
        return $this->details;
    }

    public function getDetail(string $name, $default = null)
    {
        return $this->details[$name] ?? $default;
    }

    public function getIdentifier()
    {
        return $this->getName();
    }
}
