<?php

namespace App\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use App\Models\Voiture;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;
use Dompdf\Dompdf;

class ReservationController
{
    public function index()
    {
        Auth::admin();

        $reservation = new Reservation();

        $reservations = $reservation->select();

        return View::render(
            'reservation/index',
            [
                'reservations' => $reservations
            ]
        );
    }

    public function show($data = [])
    {
        if (isset($data['id'])) {

            $id = $data['id'];

            $reservation = new Reservation();

            $result = $reservation->selectId($id);

            if ($result) {

                return View::render(
                    'reservation/show',
                    [
                        'reservation' => $result
                    ]
                );

            } else {

                View::redirect('reservations');

            }

        } else {

            View::redirect('reservations');

        }
    }

    public function create($data = [])
{
    Auth::session();

    $voiture = new Voiture();

    return View::render(
        'reservation/create',
        [
            'voitures' => $voiture->select(),
            'voiture_id' => $data['id'] ?? null
        ]
    );
}

    public function store(array $data)
    {
        Auth::session();

        // Client associé automatiquement
        $data['client_id'] = $_SESSION['client_id'];

        $validator = new Validator();

        $validator->field(
            'voiture_id',
            $data['voiture_id'] ?? ''
        )
        ->required()
        ->int();

        $validator->field(
            'date_debut',
            $data['date_debut'] ?? ''
        )
        ->required();

        $validator->field(
            'date_fin',
            $data['date_fin'] ?? ''
        )
        ->required();

        if ($validator->isSuccess()) {

            $reservation = new Reservation();

            $insert = $reservation->insert($data);

            if ($insert) {

                return View::redirect(
                    'reservation/show?id=' . $insert
                );

            } else {

                echo "Erreur d'insertion";

            }

        } else {

            $voiture = new Voiture();

            return View::render(
                'reservation/create',
                [
                    'errors' => $validator->getErrors(),
                    'reservation' => $data,
                    'voitures' => $voiture->select()
                ]
            );
        }
    }

    public function edit($data = [])
    {
        Auth::admin();

        if (isset($data['id'])) {

            $id = $data['id'];

            $reservation = new Reservation();

            $result = $reservation->selectId($id);

            if ($result) {

                $client = new Client();
                $voiture = new Voiture();

                return View::render(
                    'reservation/edit',
                    [
                        'reservation' => $result,
                        'clients' => $client->select(),
                        'voitures' => $voiture->select()
                    ]
                );

            } else {

                View::redirect('reservations');

            }

        } else {

            View::redirect('reservations');

        }
    }

    public function update(array $data)
    {
        Auth::admin();

        if (!isset($data['id'])) {

            return View::redirect('reservations');

        }

        $id = $data['id'];

        $validator = new Validator();

        $validator->field(
            'client_id',
            $data['client_id'] ?? ''
        )
        ->required()
        ->int();

        $validator->field(
            'voiture_id',
            $data['voiture_id'] ?? ''
        )
        ->required()
        ->int();

        $validator->field(
            'date_debut',
            $data['date_debut'] ?? ''
        )
        ->required();

        $validator->field(
            'date_fin',
            $data['date_fin'] ?? ''
        )
        ->required();

        if ($validator->isSuccess()) {

            $reservation = new Reservation();

            $update = $reservation->update(
                $data,
                $id
            );

            if ($update) {

                return View::redirect(
                    'reservation/show?id=' . $id
                );

            } else {

                echo "Erreur lors de la mise à jour.";

            }

        } else {

            $client = new Client();
            $voiture = new Voiture();

            return View::render(
                'reservation/edit',
                [
                    'errors' => $validator->getErrors(),
                    'reservation' => $data,
                    'clients' => $client->select(),
                    'voitures' => $voiture->select()
                ]
            );
        }
    }

    public function delete(array $data)
    {
        Auth::admin();

        if (!isset($data['id'])) {

            return View::redirect('reservations');

        }

        $id = $data['id'];

        $reservation = new Reservation();

        $delete = $reservation->delete($id);

        if ($delete) {

            return View::redirect('reservations');

        } else {

            echo "Erreur lors de la suppression.";

        }
    }

    public function pdf($id)
    {
        $reservation = new Reservation();

        $reservation = $reservation->selectId($id);

        $dompdf = new Dompdf();

        $html = "
            <h1>Réservation</h1>

            <p>Client : {$reservation['client_nom']}</p>

            <p>Voiture : {$reservation['voiture_modele']}</p>

            <p>Date début : {$reservation['date_debut']}</p>

            <p>Date fin : {$reservation['date_fin']}</p>

            <p>Statut : {$reservation['statut']}</p>
        ";

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream(
            'reservation.pdf',
            ['Attachment' => false]
        );
    }

    /**
     * Affiche uniquement les réservations
     * du client connecté
     */
    public function mesReservations()
    {
        Auth::session();

        $reservation = new Reservation();

        $reservations = $reservation->findByClient(
            $_SESSION['client_id']
        );

        return View::render(
            'reservation/mes-reservations',
            [
                'reservations' => $reservations
            ]
        );
    }
}