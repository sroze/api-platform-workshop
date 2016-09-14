<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"book_default_out"}},
 *     "denormalization_context"={"groups"={"book_default_in"}}
 *     },
 *     collectionOperations={
 *      "post"={"method"="POST"},
 *      "get"={
 *       "method"="GET",
 *       "normalization_context"={"groups"={"book_collection_out"}}
 *   }
 *     },
 *      itemOperations={
 *      "put"={"method"="PUT"},
 *      "publish-reviews"={"route_name"="book_publish_reviews"},
 *      "get"={
 *       "method"="GET",
 *       "normalization_context"={"groups"={"book_item_out", "review_default_out"}}
 *     }
 *     })
 *
 * @ORM\Entity
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Groups({"book_collection_out"})
     *
     * @var string
     */
    private $uuid;

    /**
     * @ORM\Column(type="string")
     * @Groups({"book_collection_out", "book_default_in"})
     * @Assert\Type(type="string")
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="book")
     * @Groups({"book_item_out", "book_default_in"})
     * @var Collection
     */
    private $reviews;

    /**
     * Book constructor.
     *
     */
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    /**
     * @param Review[] $reviews
     */
    public function setReviews(array $reviews)
    {
        $this->reviews = $reviews;
    }
}
