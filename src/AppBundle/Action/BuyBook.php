<?php

namespace AppBundle\Action;

use AppBundle\Entity\Book;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BuyBook
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route(
     *     "/books/{id}/buy",
     *     name="book_buy",
     *     methods={"POST"},
     *     defaults={"_api_resource_class"=Book::class, "_api_item_operation_name"="buy"}
     * )
     */
    public function __invoke(Book $book, Request $request)
    {
        $this->logger->info('The user wants to buy a book', [
            'uuid' => $book->getUuid(),
            'name' => $book->getName(),
            'contexts' => $request->getContent(),
        ]);

        $book->setName($book->getName() . ' (Bought)');

        return $book;
    }
}
