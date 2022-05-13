<?php

namespace App\Controller;

use App\Model\ToolManager;
use App\Model\ReservationManager;

class ReservationController extends AbstractController
{
    public function insertReservation(): string
    {
        // var_dump($_GET);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = array_map('trim', $_POST);
            $reservation['user_id'] = 1;
            $id = $_GET['id'];
            $reservationManager = new ReservationManager();
            $reservationManager->insertReservation($reservation, $id);
            header('Location: /reservation-confirmed');
        }
        return $this->twig->render('Home/_form.html.twig');
    }

    public function reservationConfirmed()
    {
        return $this->twig->render('Home/reservation-confirmed.html.twig');
    }

    public function myReservations()
    {
        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->selectAllReserved();
        if ($reservations) {
            foreach ($reservations as $reservation) {
                $reservation = $reservation;
            }
            $toolManager = new ToolManager();
            $tool = $toolManager->selectOneById($reservation['tool_id']);
        } else {
            return $this->twig->render('Home/mes-reservations.html.twig');
        }
        return $this->twig->render('Home/mes-reservations.html.twig', [
          'reservations' => $reservations,
          'tool' => $tool
        ]);
    }

    public function annulation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $reservationManager = new ReservationManager();
            $reservationManager->delete($id);
            header('Location: /mes-reservations');
        }

        return $this->twig->render('Home/mes-reservations.html.twig');
    }
}
