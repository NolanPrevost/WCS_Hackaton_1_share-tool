<?php

namespace App\Controller;

use App\Model\WishlistManager;
use App\Model\VoteManager;

class WishlistController extends AbstractController
{
  /**
   * List wishItems
   */
    public function index(): string
    {
        $wishlistManager = new WishlistManager();
        $wishitems = $wishlistManager->selectAll();

        return $this->twig->render('Wishlist/index.html.twig', ['wishitems' => $wishitems]);
    }

  /**
   * Show informations for a specific wish item
   */
    public function show(int $id)
    {
        $wishlistManager = new WishlistManager();
        $wishitem = $wishlistManager->selectOneById($id); {
        $voteManager = new VoteManager();
        $votes = $voteManager->selectVoteByWishId($id);
        if (empty($wishitem)) {
            header('Location:/');
        }
        $voteManager = new VoteManager();
        $votes = $voteManager->selectVoteByWishId($id);

        return $this->twig->render('Wishlist/show.html.twig', ['wishitem' => $wishitem, 'votes' => $votes]);
        }
    }

  /**
   * Edit a specific item
   */
    public function edit(int $id): ?string
    {
        $wishlistManager = new WishlistManager();
        $wishitem = $wishlistManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wishitem = array_map('trim', $_POST);
            $wishlistManager->update($wishitem);

            header('Location: /wishlist/show?id=' . $id);
            return null;
        }

        return $this->twig->render('wishlist/edit.html.twig', [
        'wishitem' => $wishitem,
        ]);
    }

  /**
   * Add a new item
   */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wishitem = array_map('trim', $_POST);
            $wishlistManager = new WishlistManager();
            $wishlistManager->insert($wishitem);

            header('Location:/wishlist');
            return null;
        }

        return $this->twig->render('wishlist/add.html.twig');
    }

  /**
   * Delete a specific item
   */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $wishlistManager = new WishlistManager();
            $wishlistManager->delete((int)$id);

            header('Location:/wishlist');
        }
    }
}
