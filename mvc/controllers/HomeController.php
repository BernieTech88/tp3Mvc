<?php

namespace App\Controllers;

use App\Providers\View;

/**
 * Contrôleur responsable de la page d'accueil.
 *
 * Transmet à la vue les informations de session
 * nécessaires pour adapter l'affichage selon
 * l'état de connexion de l'utilisateur.
 */
class HomeController
{
    /**
     * Affiche la page d'accueil.
     *
     * Détermine si un utilisateur est connecté et
     * transmet à la vue son nom ainsi que son niveau
     * de privilège pour personnaliser l'interface.
     *
     * @return void
     */
    public function index()
    {
        return View::render(
            'home/index',
            [
                'isConnected' => isset($_SESSION['user_id']),
                'user_name' => $_SESSION['user_name'] ?? null,
                'privilege_id' => $_SESSION['privilege_id'] ?? null
            ]
        );
    }
}