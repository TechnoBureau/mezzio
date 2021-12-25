<?php
declare(strict_types=1);
namespace TechnoBureau\User\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Entities as OAuth;

/**
 * OauthAccessTokens
 */
class OauthAccessTokens implements OAuth\AccessTokenEntityInterface
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var bool
     */
    private $isrevoked = '';

    /**
     * @var datetime_immutable
     */
    private \DateTimeImmutable $expiresdatetime;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \TechnoBureau\User\Entity\OauthClients
     */
    private OAuth\ClientEntityInterface $client;

    /**
     * @var \TechnoBureau\User\Entity\AuthUser
     */
    private ?User $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private Collection $scope;

    private ?CryptKey $privateKey = null;

    private ?Configuration $jwtConfiguration = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = 0;
        $this->expiresDatetime = new \DateTimeImmutable();
        $this->user = null;
        $this->token = '';
        $this->scope = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set token.
     *
     * @param string $token
     *
     * @return OauthAccessTokens
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set isrevoked.
     *
     * @param bool $isrevoked
     *
     * @return OauthAccessTokens
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
     * @return OauthAccessTokens
     */
    public function setExpiresdatetime(\DateTimeImmutable $expiresdatetime)
    {
        $this->expiresdatetime = $expiresdatetime;

        return $this;
    }

    /**
     * Get expiresdatetime.
     *
     * @return datetime_immutable
     */
    public function getExpiresdatetime(): \DateTimeImmutable
    {
        return $this->expiresdatetime;
    }

    public function getExpiryDateTime(): \DateTimeImmutable
    {
        return $this->getExpiresDatetime();
    }

    public function setExpiryDateTime(\DateTimeImmutable $dateTime): self
    {
        return $this->setExpiresDatetime($dateTime);
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
     * Set client.
     *
     * @param \TechnoBureau\User\Entity\OauthClients|null $client
     *
     * @return OauthAccessTokens
     */
    public function setClient(OAuth\ClientEntityInterface $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client.
     *
     * @return \TechnoBureau\User\Entity\OauthClients|null
     */
    public function getClient(): OAuth\ClientEntityInterface
    {
        return $this->client;
    }

    /**
     * Set user.
     *
     * @param \TechnoBureau\User\Entity\AuthUser|null $user
     *
     * @return OauthAccessTokens
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

    /**
     * Add scope.
     *
     * @param \TechnoBureau\User\Entity\OauthScopes $scope
     *
     * @return OauthAccessTokens
     */
    public function addScope(OAuth\ScopeEntityInterface $scope)
    {
        $this->scope[] = $scope;

        return $this;
    }

    /**
     * Remove scope.
     *
     * @param \TechnoBureau\User\Entity\OauthScopes $scope
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeScope(OAuthScope $scope)
    {
        return $this->scope->removeElement($scope);
    }

    /**
     * Get scope.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    /** @psalm-suppress MixedInferredReturnType */
    public function getScope(?Criteria $criteria = null): array
    {
        if ($criteria === null) {
            /** @psalm-suppress MixedReturnTypeCoercion */
            return $this->scope->toArray();
        }

        /**
         * @psalm-suppress UndefinedInterfaceMethod
         * @psalm-suppress MixedReturnStatement
         * @psalm-suppress MixedMethodCall
         */
        return $this->scope->matching($criteria)->toArray();
    }

    public function getIdentifier(): string
    {
        return $this->getToken();
    }

    /** @psalm-suppress MixedArgument */
    public function setIdentifier($identifier): self
    {
        return $this->setToken($identifier);
    }

    public function setUserIdentifier($identifier): self
    {
        // not sure what this is for
        // just making the interface happy for now
        return $this;
    }

    public function getUserIdentifier()
    {
        if (null === $user = $this->getUser()) {
            return '';
        }

        return $user->getIdentifier();
    }

    /** Set key used to encrypt token */
    public function setPrivateKey(CryptKey $privateKey): self
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /** Initialise the JWT Configuration. */
    public function initJwtConfiguration(): self
    {
        if (null === $this->privateKey) {
            throw new \RuntimeException('Unable to init JWT without private key');
        }
        $this->jwtConfiguration = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::plainText(
                $this->privateKey->getKeyContents(),
                $this->privateKey->getPassPhrase() ?? ''
            ),
            InMemory::plainText('')
        );

        return $this;
    }

    /**
     * Generate a JWT from the access token
     */
    private function convertToJWT(): Token
    {
        $this->initJwtConfiguration();

        if (null === $this->jwtConfiguration) {
            throw new \RuntimeException('Unable to convert to JWT without config');
        }

        return $this->jwtConfiguration->builder()
            ->permittedFor($this->getClient()->getIdentifier())
            ->identifiedBy($this->getIdentifier())
            ->issuedAt(new \DateTimeImmutable())
            ->canOnlyBeUsedAfter(new \DateTimeImmutable())
            ->expiresAt($this->getExpiryDateTime())
            ->relatedTo((string) $this->getUserIdentifier())
            ->withClaim('scope', $this->getScope())
            ->getToken($this->jwtConfiguration->signer(), $this->jwtConfiguration->signingKey());
    }

    /**
     * Generate a string representation from the access token
     */
    public function __toString(): string
    {
        return $this->convertToJWT()->toString();
    }
}
