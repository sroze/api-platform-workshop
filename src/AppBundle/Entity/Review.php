<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"review_default_out"}},
 *     "denormalization_context"={"groups"={"review_default_in"}},
 *     })
 *
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Groups({"review_default_out"})
     *
     * @var string
     */
    private $uuid;

    /**
     * @ORM\Column(type="text")
     * @Groups({"review_default_out", "review_default_in"})
     * @var string
     */
    private $contents;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"review_default_out", "review_default_in"})
     *
     * @var boolean
     */
    private $published;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     * @ORM\JoinColumn(name="book_uuid", referencedColumnName="uuid")
     * @Groups({"review_default_out", "review_default_in"})
     *
     * @var Book
     */
    private $book;

    public function __construct(Book $book, string $contents)
    {
        $this->contents = $contents;
        $this->book = $book;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getContents(): string
    {
        return $this->contents;
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }

    /**
     * @return bool
     */
    public function isPublished() : bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }
}
