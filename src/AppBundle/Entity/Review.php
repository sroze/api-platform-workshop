<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity
 *
 * @ApiResource
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @var string
     */
    private $uuid;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $contents;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     * @ORM\JoinColumn(name="book_uuid", referencedColumnName="uuid")
     *
     * @var Book
     */
    private $book;
}
