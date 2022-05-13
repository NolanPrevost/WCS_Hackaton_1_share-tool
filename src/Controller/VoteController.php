<?php

namespace App\Controller;

use App\Model\VoteManager;
use App\Model\WishlistManager;
use Exception;

class VoteController extends AbstractController
{
    /**
     * List votes
     */
    public function index(): string
    {
        $voteManager = new VoteManager();
        $votes = $voteManager->selectAll();

        return $this->twig->render('Vote/index.html.twig', ['votes' => $votes]);
    }

    /**
     * Show informations for a specific vote
     */
    public function show(int $id): string
    {
        $voteManager = new VoteManager();
        $vote = $voteManager->selectVoteByWishId($id);

        return $this->twig->render('Vote/show.html.twig', ['vote' => $vote]);
    }

    /**
     * Edit a specific vote
     */
    public function edit(int $id): ?string
    {
        $voteManager = new VoteManager();
        $vote = $voteManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vote = array_map('trim', $_POST);
            if (!empty($vote['vote']) && !empty($vote['user_id']) && !empty($vote['wishlist_id'])) {
                $voteManager->update($vote);
                header('Location:/votes/show?id=' . $id);
                return null;
            } else {
                throw new Exception('The vote cannot be updated.');
            }
        }
        return $this->twig->render('Vote/edit.html.twig', [
            'vote' => $vote,
        ]);
    }

    public function voteConfirmed()
    {
        return $this->twig->render('Home/vote-confirmed.html.twig');
    }

    /**
     * Add a new vote
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vote = array_map('trim', $_POST);
            if (!empty($vote['vote']) && !empty($vote['user_id']) && !empty($vote['wishlist_id'])) {
                $voteManager = new VoteManager();
                $id = $voteManager->insert($vote);
                header('Location:/votes/show?id=' . $id);
                return null;
            } else {
                throw new Exception('The vote cannot be created.');
            }
        }
        return $this->twig->render('Vote/add.html.twig');
    }

    /**
     * Delete a specific vote
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $voteManager = new VoteManager();
            $voteManager->delete((int)$id);

            header('Location:/votes');
        }
    }
}
