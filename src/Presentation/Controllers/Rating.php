<?php

namespace Presentation\Controllers;

use Application\Query\SignedInUserQuery;
use Application\Util\RatingData;

class Rating extends \Presentation\MVC\Controller
{
    public function __construct(
        private \Application\Command\CreateRatingCommand  $createRatingCommand,
        private \Application\Query\RatingQuery            $ratingQuery,
        private \Application\Query\SignedInUserQuery      $SignedInUserQuery,
        private \Application\Interfaces\ProductRepository $productRepository,
        private \Application\Interfaces\RatingRepository  $ratingRepository,
        private \Application\Command\UpdateRatingCommand  $updateRatingCommand,
        private \Application\Command\DeleteRatingCommand  $deleteRatingCommand,
    )
    {
    }

    public function GET_Add(): \Presentation\MVC\ActionResult
    {

        $user = $this->SignedInUserQuery->execute();
        if (!$user)
            return $this->view('login', [
                'user' => null,
                'userName' => '',
                'context' => $this->getRequestUri(),
                'errors' => ['You need to be logged in to rate a product']

            ]);

        return $this->view('rating', [
            'user' => $user,
            'userName' => $user->userName,
            'productId' => $this->getParam('pid'),
            'productName' => $this->productRepository->getProductById($this->getParam('pid'))->productName,
            'rating' => $this->ratingRepository->getRatingForUserAndProduct($this->getParam('pid'), $user->userName),
        ]);
    }

    public function GET_Overview(): \Presentation\MVC\ActionResult
    {
        return $this->view('productOverview', [
            'user' => $this->SignedInUserQuery->execute(),
            'userName' => $this->SignedInUserQuery->execute()->userName ?? '',
            'ratings' => $this->ratingQuery->execute($this->getParam('pid')),
            'productName' => $this->productRepository->getProductById($this->getParam('pid'))->productName,
            'context' => $this->getRequestUri()
        ]);
    }

    public function POST_CREATE(): \Presentation\MVC\ActionResult
    {
        // no check for userName needed, because only logged in users can rate
        $rating = $this->getParam('rate');
        if ($rating < 1 || $rating > 5)
            return $this->view('rating', [
                'user' => $this->SignedInUserQuery->execute(),
                'userName' => $this->SignedInUserQuery->execute()->userName,
                'productId' => $this->getParam('pid'),
                'productName' => $this->productRepository->getProductById($this->getParam('pid'))->productName,
                'rating' => $this->ratingRepository->getRatingForUserAndProduct($this->getParam('pid'), $this->SignedInUserQuery->execute()->userName),
                'errors' => ['Rating must be between 1 and 5']
            ]);
        $username = $this->SignedInUserQuery->execute()->userName;
        $comment = $this->getParam('comment') ?? '';
        $date = date('Y-m-d', time());
        $productId = $this->getParam('pid');
        // its not possible to create more than 1 rating for a product
        if ($this->getParam('newRating') != 1)
            $this->updateRatingCommand->execute(new \Application\Util\RatingData($username, $rating, $comment, $date, $productId));
        else {
            $this->createRatingCommand->execute($username, $rating, $comment, $date, $productId);
        }

        return $this->redirect('Products', 'index', ['id' => $productId]);
    }

    public function POST_Delete(): \Presentation\MVC\ActionResult
    {
        $this->deleteRatingCommand->execute($this->getParam('pid'), $this->SignedInUserQuery->execute()->userName);
        return $this->redirect('Products', 'index', ['id' => null]);
    }
}