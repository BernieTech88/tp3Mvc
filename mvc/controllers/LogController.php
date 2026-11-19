<?php

namespace App\Controllers;

use App\Models\Log;
use App\Providers\View;
use App\Providers\Auth;

/**
 * Contrôleur responsable de la consultation
 * des journaux d'activités de l'application.
 *
 * L'accès est réservé aux administrateurs.
 */
class LogController
{
    /**
     * Affiche la liste des journaux d'activités.
     *
     * Récupère les entrées enregistrées dans la
     * table des logs et les affiche en ordre
     * décroissant selon leur identifiant.
     *
     * @return void
     */
    public function index()
    {
        Auth::admin();

        $log = new Log();

        $logs = $log->select(
            'id',
            'DESC'
        );

        return View::render(
            'log/index',
            [
                'logs' => $logs
            ]
        );
    }
}