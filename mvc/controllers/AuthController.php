<?php

namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

/**
 * Contrôleur responsable de l'authentification des utilisateurs.
 *
 * Permet :
 * - l'affichage du formulaire de connexion;
 * - la validation des identifiants;
 * - l'ouverture de session;
 * - la déconnexion de l'utilisateur.
 */
class AuthController
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return void
     */
    public function create()
    {
        return View::render('auth/create');
    }

    /**
     * Traite la soumission du formulaire de connexion.
     *
     * Valide les données reçues puis vérifie les
     * informations d'authentification de l'utilisateur.
     *
     * @param array $data Données soumises par le formulaire.
     * @return void
     */
    public function store(array $data)
    {
        $validator = new Validator();

        $validator->field('username', $data['username'])
            ->required()
            ->max(100);

        $validator->field('password', $data['password'])
            ->required()
            ->min(6)
            ->max(20);

        if ($validator->isSuccess()) {

            $user = new User();

            $isConnected = $user->checkUser(
                $data['username'],
                $data['password']
            );

            if ($isConnected) {

                /**
                 * Redirige l'administrateur vers la page d'accueil
                 * après une authentification réussie.
                 */
                if ($_SESSION['privilege_id'] == 1) {
                    return View::redirect('home');
                }
            }

            $errors['message'] =
                'Nom d\'utilisateur ou mot de passe invalide';

            return View::render('auth/create', [
                'errors' => $errors,
                'user' => $data
            ]);
        }

        $errors = $validator->getErrors();

        return View::render('auth/create', [
            'errors' => $errors,
            'user' => $data
        ]);
    }

    /**
     * Déconnecte l'utilisateur courant et détruit la session.
     *
     * @return void
     */
    public function delete()
    {
        session_unset();
        session_destroy();

        return View::redirect('login');
    }

    /**
     * Méthode réservée aux validations d'authentification futures.
     *
     * @return void
     */
    public function auth()
    {
        // Validation de l'utilisateur
    }

    /**
     * Déconnecte l'utilisateur et le redirige vers l'accueil.
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();

        header('location: /');
        exit;
    }
}