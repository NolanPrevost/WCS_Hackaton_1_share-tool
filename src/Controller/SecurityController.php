<?php

namespace App\Controller;

use App\Model\UserManager;

class SecurityController extends AbstractController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            header('Location: /');
        }
        return $this->twig->render('Security/login.html.twig');
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
    }
}
