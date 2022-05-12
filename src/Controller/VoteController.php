<?php

namespace App\Controller;

use App\Model\VoteManager;

class VoteController extends AbstractController
{
        /**
     * Add a new user
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $vote = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $voteManager = new VoteManager();
            $id = $voteManager->insert($vote);

            header('Location:/votes/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Vote/add.html.twig');
    }
}
