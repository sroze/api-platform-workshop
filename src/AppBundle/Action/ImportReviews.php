<?php

namespace AppBundle\Action;

use AppBundle\Entity\Book;
use AppBundle\Entity\Review;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ImportReviews
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route(
     *     "/books/{id}/import-reviews",
     *     name="book_import_reviews",
     *     methods={"POST"},
     *     defaults={"_api_resource_class"=Book::class, "_api_item_operation_name"="import-reviews"}
     * )
     */
    public function __invoke(Book $data, Request $request)
    {
        array_map(function($contents) use ($data) {
            $data->getReviews()->add(new Review($data, $contents));
        }, explode('¯\_(ツ)_/¯', $request->getContent()));

        return $data;
    }
}
