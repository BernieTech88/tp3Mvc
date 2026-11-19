<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

/**
 * Contrôleur responsable de l'inscription des nouveaux utilisateurs.
 *
 * Gère :
 * - l'affichage du formulaire d'inscription;
 * - la validation des données saisies;
 * - la création du client;
 * - la création du compte utilisateur.
 */
class RegisterController
{
    /**
     * Affiche le formulaire d'inscription.
     *
     * @return void
     */
    public function create()
    {
        return View::render('register/create');
    }

    /**
     * Traite la soumission du formulaire d'inscription.
     *
     * Vérifie la validité des données, crée un client
     * puis crée le compte utilisateur associé.
     *
     * @param array $data Données soumises par le formulaire.
     * @return void
     */
    public function store(array $data)
    {
        $validator = new Validator();

        $validator->field('nom', $data['nom'])
            ->required()
            ->min(2)
            ->max(100);

        $validator->field('prenom', $data['prenom'])
            ->required()
            ->min(2)
            ->max(100);

        $validator->field('username', $data['username'])
            ->required()
            ->min(3)
            ->max(100);

        $validator->field('email', $data['email'])
            ->required()
            ->email();

        $validator->field('password', $data['password'])
            ->required()
            ->min(6)
            ->max(20);

        /**
         * Retourne le formulaire avec les erreurs de validation
         * si certaines données sont invalides.
         */
        if (!$validator->isSuccess()) {

            return View::render(
                'register/create',
                [
                    'errors' => $validator->getErrors(),
                    'user'   => $data
                ]
            );
        }

        $user = new User();

        /**
         * Vérifie que le nom d'utilisateur n'est pas déjà utilisé.
         */
        if ($user->unique('username', $data['username'])) {

            return View::render(
                'register/create',
                [
                    'errors' => [
                        'username' =>
                            'Nom d\'utilisateur déjà utilisé'
                    ],
                    'user' => $data
                ]
            );
        }

        /**
         * Création de l'enregistrement client.
         */
        $client = new Client();

        $clientId = $client->insert([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'telephone' => $data['telephone']
        ]);

        /**
         * Création du compte utilisateur associé au client.
         */
        $user->insert([
            'name' => $data['prenom'] . ' ' . $data['nom'],
            'username' => $data['username'],
            'password' => $user->hashPassword(
                $data['password']
            ),
            'email' => $data['email'],
            'privilege_id' => 2,
            'client_id' => $clientId
        ]);

        /**
         * Redirige l'utilisateur vers la page de connexion
         * après une inscription réussie.
         */
        return View::redirect('login');
    }
}