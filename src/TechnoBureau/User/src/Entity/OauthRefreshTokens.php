<?php

declare(strict_types=1);

namespace TechnoBureau\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities as OAuth;
use DateTimeImmutable;

/**
 * OauthRefreshTokens
 */
class OauthRefreshTokens implements OAuth\RefreshTokenEntityInterface
{
    /**
     * @var bool
     */
    private $isrevoked = '';

    /**
     * @var datetime_immutable
     */
    private $expiresdatetime;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \TechnoBureau\User\Entity\OauthAccessTokens
     */
    private $accessToken;

    public function __construct()
    {
        $this->id = 0;
        $this->expiresDatetime = new DateTimeImmutable();
    }

    /**
     * Set isrevoked.
     *
     * @param bool $isrevoked
     *
     * @return OauthRefreshTokens
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
     * Set expiresdatetime.
     *
     * @param datetime_immutable $expiresdatetime
     *
     * @return OauthRefreshTokens
     */
    public function setExpiresdatetime($expiresdatetime)
    {
        $this->expiresdatetime = $expiresdatetime;

        return $this;
    }

    /**
     * Get expiresdatetime.
     *
     * @return datetime_immutable
     */
    public function getExpiresdatetime()
    {
        return $this->expiresdatetime;
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
     * Set accessToken.
     *
     * @param \TechnoBureau\User\Entity\OauthAccessTokens|null $accessToken
     *
     * @return OauthRefreshTokens
     */
    public function setAccessToken(OAuth\AccessTokenEntityInterface $accessToken = null)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken.
     *
     * @return \TechnoBureau\User\Entity\OauthAccessTokens|null
     */
    public function getAccessToken(): OAuthAccessToken
    {
        return $this->accessToken;
    }

    public function getIdentifier(): string
    {
        return (string)$this->getId();
    }

    /**
     * @return static
     */
    public function setIdentifier(mixed $identifier)
    {
        $this->setId((int)$identifier);

        return $this;
    }

    public function getExpiryDateTime(): DateTimeImmutable
    {
        return $this->getExpiresDatetime();
    }

    public function setExpiryDateTime(DateTimeImmutable $dateTime): self
    {
        return $this->setExpiresDatetime($dateTime);
    }
}
