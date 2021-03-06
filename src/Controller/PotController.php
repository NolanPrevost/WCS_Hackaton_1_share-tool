<?php

namespace App\Controller;

use App\Model\PotManager;

class PotController extends AbstractController
{
    public function index()
    {
        $potManager = new PotManager();
        $pots = $potManager->selectAll();

        return $this->twig->render('Pot/index.html.twig', ['pots' => $pots]);
    }

    /**
     * Show informations for a specific pot
     */
    public function show(int $id): string
    {
        $potManager = new PotManager();
        $pot = $potManager->selectOneById($id);

        return $this->twig->render('Pot/show.html.twig', ['pot' => $pot]);
    }

    /**
     * Edit a specific pot
     */
    public function edit(int $id): ?string
    {
        $potManager = new PotManager();
        $pot = $potManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pot = array_map('trim', $_POST);
            $potManager->update($pot);

            header('Location: /pots/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Pot/edit.html.twig', [
            'pot' => $pot,
        ]);
    }
}
