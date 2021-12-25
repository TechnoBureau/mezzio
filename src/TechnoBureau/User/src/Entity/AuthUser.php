<?php
declare(strict_types=1);

namespace TechnoBureau\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mezzio\Authentication\UserInterface as MezzioUserInterface;
use League\OAuth2\Server\Entities\UserEntityInterface as OAuth2UserInterface;

/**
 * AuthUser
 */
class AuthUser implements MezzioUserInterface, OAuth2UserInterface
{
    /**
     * @var string|null
     */
    private $password;

    /**
     * @var \DateTime|null
     */
    private $lastLogin;

    /**
     * @var bool
     */
    private $isSuperuser;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string|null
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var bool
     */
    private $isStaff;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var \DateTime
     */
    private $dateJoined;

    /**
     * @var int
     */
    private $id;

    private array $roles = [];

    private array $details = [];

    public function __construct()
    {
        $this->id = 0;
        $this->email = '';
        $this->password = '';
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return AuthUser
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set lastLogin.
     *
     * @param \DateTime|null $lastLogin
     *
     * @return AuthUser
     */
    public function setLastLogin($lastLogin = null)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin.
     *
     * @return \DateTime|null
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set isSuperuser.
     *
     * @param bool $isSuperuser
     *
     * @return AuthUser
     */
    public function setIsSuperuser($isSuperuser)
    {
        $this->isSuperuser = $isSuperuser;

        return $this;
    }

    /**
     * Get isSuperuser.
     *
     * @return bool
     */
    public function getIsSuperuser()
    {
        return $this->isSuperuser;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return AuthUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return AuthUser
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string|null $lastName
     *
     * @return AuthUser
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return AuthUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isStaff.
     *
     * @param bool $isStaff
     *
     * @return AuthUser
     */
    public function setIsStaff($isStaff)
    {
        $this->isStaff = $isStaff;

        return $this;
    }

    /**
     * Get isStaff.
     *
     * @return bool
     */
    public function getIsStaff()
    {
        return $this->isStaff;
    }

    /**
     * Set isActive.
     *
     * @param bool $isActive
     *
     * @return AuthUser
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive.
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set dateJoined.
     *
     * @param \DateTime $dateJoined
     *
     * @return AuthUser
     */
    public function setDateJoined($dateJoined)
    {
        $this->dateJoined = $dateJoined;

        return $this;
    }

    /**
     * Get dateJoined.
     *
     * @return \DateTime
     */
    public function getDateJoined()
    {
        return $this->dateJoined;
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

    /**
     * Set id.
     *
     * @return AuthUser
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIdentifier(): string
    {
        return $this->getEmail();
    }

    public function getIdentity(): string
    {
        return $this->getEmail();
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

    public function getDetail(string $name, $default = null)
    {
        return $this->details[$name] ?? $default;
    }

    public function setDetails(array $details): self
    {
        $this->details = $details;

        return $this;
    }

    /** @psalm-suppress MixedReturnTypeCoercion */
    public function getDetails(): array
    {
        /** @psalm-suppress MixedReturnTypeCoercion */
        return $this->details;
    }
}
