<?php

namespace App\Controller;

use App\Model\ToolManager;

class ToolController extends AbstractController
{
    public function index(): string
    {
        $toolManager = new ToolManager();
        $tools = $toolManager->selectAll('name');
        return $this->twig->render('Home/index.html.twig', ['tools' => $tools,]);
    }

    public function show(int $id): string
    {
        $toolManager = new ToolManager();
        $tool = $toolManager->selectOneById($id);

        return $this->twig->render('Tool/show.html.twig', ['tool' => $tool]);
    }

        /**
     * Edit a specific tool
     */
    public function edit(int $id): ?string
    {
        $toolManager = new ToolManager();
        $tool = $toolManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $tool = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $toolManager->update($tool);

            header('Location: /tools/show?id=' . $id);
            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Tool/edit.html.twig', ['tool' => $tool]);
    }

    public function toolReservation(): string
    {
        // var_dump($_GET);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = array_map('trim', $_POST);
            $id = $_GET['id'];
            // var_dump($reservation); die;
            $toolManager = new ToolManager();
            $toolManager->toggleReservation($reservation, $id);
            header('Location: /reservation-confirmed');
        }
        return $this->twig->render('Home/_form.html.twig');
    }

    public function reservationConfirmed()
    {
        return $this->twig->render('Home/reservation-confirmed.html.twig');
    }

    public function myReservation()
    {
        $toolManager = new ToolManager();
        $tools = $toolManager->selectAllReserved();
        return $this->twig->render('Home/mes-reservations.html.twig', ['tools' => $tools]);
    }

    public function annulation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $toolManager = new ToolManager();
            $toolManager->toggleAnnulation($id);
            header('Location: /mes-reservations');
        }

        return $this->twig->render('Home/mes-reservations.html.twig');
    }
}
