<?php
declare(strict_types=1);
namespace TechnoBureau\User\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities as OAuth;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OauthAuthCodes
 */
class OauthAuthCodes implements OAuth\AuthCodeEntityInterface
{
    use OAuth\Traits\AuthCodeTrait;

    /**
     * @var bool
     */
    private $isrevoked = '';

    /**
     * @var datetime_immutable|null
     */
    private DateTimeImmutable $expiresdatetime;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \TechnoBureau\User\Entity\OauthClients
     */
    private OAuth\ClientEntityInterface $client;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected Collection $scope;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = 0;
        $this->expiresDatetime = new DateTimeImmutable();
        $this->scope = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isrevoked.
     *
     * @param bool $isrevoked
     *
     * @return OauthAuthCodes
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
     * @param datetime_immutable|null $expiresdatetime
     *
     * @return OauthAuthCodes
     */
    public function setExpiresdatetime(DateTimeImmutable $expiresdatetime = null)
    {
        $this->expiresdatetime = $expiresdatetime;

        return $this;
    }

    /**
     * Get expiresdatetime.
     *
     * @return datetime_immutable|null
     */
    public function getExpiresdatetime(): DateTimeImmutable
    {
        return $this->expiresdatetime;
    }

    public function getExpiryDateTime(): DateTimeImmutable
    {
        return $this->getExpiresDatetime();
    }

    public function setExpiryDateTime(DateTimeImmutable $dateTime): self
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

    /**
     * Set client.
     *
     * @param \TechnoBureau\User\Entity\OauthClients|null $client
     *
     * @return OauthAuthCodes
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
     * Add scope.
     *
     * @param \TechnoBureau\User\Entity\OauthScopes $scope
     *
     * @return OauthAuthCodes
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
    public function getScope(?Criteria $criteria = null): array
    {
        if ($criteria === null) {
            return $this->scope->toArray();
        }
        return $this->scope->matching($criteria)->toArray();
    }
}
