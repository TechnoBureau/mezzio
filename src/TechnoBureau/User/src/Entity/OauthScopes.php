<?php

declare(strict_types=1);

namespace TechnoBureau\User\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities as OAuth;


/**
 * OauthScopes
 */
class OauthScopes implements OAuth\ScopeEntityInterface
{
    use OAuth\Traits\ScopeTrait;

    /**
     * @var string
     */
    private $scope;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $authCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $accessToken;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = 0;
        $this->scope = '';
        $this->authCode = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accessToken = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set scope.
     *
     * @param string $scope
     *
     * @return OauthScopes
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope.
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
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

    public function getIdentifier(): string
    {
        return $this->getScope();
    }

    /**
     * Add authCode.
     *
     * @param \TechnoBureau\User\Entity\OauthAuthCodes $authCode
     *
     * @return OauthScopes
     */
    public function addAuthCode(OAuthAuthCode $authCode)
    {
        if ($this->authCode->contains($authCode)) {
            return $this;
        }

        $this->authCode->add($authCode);

        return $this;
        // $this->authCode[] = $authCode;

        // return $this;
    }

    /**
     * Remove authCode.
     *
     * @param \TechnoBureau\User\Entity\OauthAuthCodes $authCode
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAuthCode(OAuthAuthCode $authCode)
    {
        return $this->authCode->removeElement($authCode);
    }

    /**
     * Get authCode.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    /** @psalm-suppress MixedInferredReturnType */
    public function getAuthCodes(?Criteria $criteria = null): Collection
    {
        if ($criteria === null) {
            /** @psalm-suppress MixedInferredReturnType */
            return $this->authCode;
        }

        /**
         * @psalm-suppress UndefinedInterfaceMethod
         * @psalm-suppress MixedReturnStatement
         */
        return $this->authCode->matching($criteria);
    }

    /**
     * Add accessToken.
     *
     * @param \TechnoBureau\User\Entity\OauthAccessTokens $accessToken
     *
     * @return OauthScopes
     */
    public function addAccessToken(OAuthAccessToken $accessToken)
    {
        if ($this->accessToken->contains($accessToken)) {
            return $this;
        }

        $this->accessToken->add($accessToken);

        return $this;
        // $this->accessToken[] = $accessToken;

        // return $this;
    }

    /**
     * Remove accessToken.
     *
     * @param \TechnoBureau\User\Entity\OauthAccessTokens $accessToken
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAccessToken(OAuthAccessToken $accessToken)
    {
        return $this->accessToken->removeElement($accessToken);
    }

    /**
     * Get accessToken.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    /** @psalm-suppress MixedInferredReturnType */
    public function getAccessToken(?Criteria $criteria = null): Collection
    {
        if ($criteria === null) {
            return $this->accessToken;
        }

        /**
         * @psalm-suppress UndefinedInterfaceMethod
         * @psalm-suppress MixedReturnStatement
         */
        return $this->accessToken->matching($criteria);
    }
}
