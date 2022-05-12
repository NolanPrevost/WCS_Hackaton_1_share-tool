<?php

namespace App\Controller;

use App\Model\WishlistManager;

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
   * Show informations for a specific item
   */
    public function show(int $id): string
    {
        $wishlistManager = new WishlistManager();
        $wishitem = $wishlistManager->selectOneById($id);

        return $this->twig->render('wishlist/show.html.twig', ['wishitem' => $wishitem]);
    }

  /**
   * Edit a specific item
   */
    public function edit(int $id): ?string
    {
        $wishlistManager = new WishlistManager();
        $wishitem = $wishlistManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // clean $_POST data
            $wishitem = array_map('trim', $_POST);

          // TODO validations (length, format...)

          // if validation is ok, update and redirection
            $wishlistManager->update($wishitem);

            header('Location: /wishlist/show?id=' . $id);

          // we are redirecting so we don't want any content rendered
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
          // clean $_POST data
            $wishitem = array_map('trim', $_POST);

          // TODO validations (length, format...)

          // if validation is ok, insert and redirection
            $wishlistManager = new WishlistManager();
            $id = $wishlistManager->insert($wishitem);

            header('Location:/wishlist/show?id=' . $id);
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
