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
     * @Assert\Type(type="string")
     *
     * @var string
     */
    private $contents;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     * @ORM\JoinColumn(name="book_uuid", referencedColumnName="uuid")
     * @Groups({"review_default_out", "review_default_in"})
     *
     * @var Book
     */
    private $book;

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
    public function getContents(): string
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     */
    public function setContents(string $contents)
    {
        $this->contents = $contents;
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }

    /**
     * @param Book $book
     */
    public function setBook(Book $book)
    {
        $this->book = $book;
    }

}
