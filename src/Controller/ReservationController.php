<?php

namespace App\Controller;

use App\Model\ToolManager;
use App\Model\ReservationManager;

class ReservationController extends AbstractController
{
    public function isReservationPossible($toolId, $startBooking, $endBooking): bool
    {
        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->selectReservationByToolId($toolId);
        if ($reservations) {
            foreach ($reservations as $reservation) {
                if (
                    $startBooking < $reservation['tool_booking_end']
                    && $startBooking > $reservation['tool_booking_start']
                ) {
                    return false;
                } elseif (
                    $endBooking < $reservation['tool_booking_end']
                    && $endBooking > $reservation['tool_booking_start']
                ) {
                    return false;
                }
            }
            return true;
        } else {
            return true;
        }
    }

    public function insertReservation(): string
    {
      // var_dump($_GET);
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = array_map('trim', $_POST);
            $reservation['user_id'] = 1;
            $id = $_GET['id'];
            if (
                $this->isReservationPossible($id, $reservation['booking_start'], $reservation['booking_end'])
                == false
            ) {
                $errors[] = "Réservation impossible, le créneau demandé n'est pas disponible";
                return $this->twig->render('Home/_form.html.twig', ['errors' => $errors]);
            }
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
