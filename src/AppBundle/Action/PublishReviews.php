<?php

namespace AppBundle\Action;

use AppBundle\Entity\Book;
use AppBundle\Entity\Review;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PublishReviews
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route(
     *     "/books/{id}/publish-reviews",
     *     name="book_publish_reviews",
     *     methods={"POST"},
     *     defaults={"_api_resource_class"=Book::class, "_api_item_operation_name"="publish-reviews"}
     * )
     */
    public function __invoke(Book $data, Request $request)
    {
        $toPublish = $data->getReviews()->filter(function(Review $review) {
            return !$review->isPublished();
        });

        $this->logger->info('Publishing book reviews', [
            'book' => $data->getUuid(),
            'reviews' => join(',', $toPublish->map(function(Review $review) {
                return $review->getUuid();
            })->toArray()),
            '3rdParty' => $request->query->get('3rd-party', 'all'),
        ]);

        $toPublish->map(function(Review $review) {
            $review->setPublished(true);
        });

        return $data;
    }
}
