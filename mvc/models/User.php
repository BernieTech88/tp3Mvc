<?php

namespace App\Models;

use App\Models\CRUD;

/**
 * Modèle représentant les utilisateurs enregistrés
 * dans la base de données.
 *
 * Gère :
 * - l'enregistrement des utilisateurs;
 * - le hachage des mots de passe;
 * - l'authentification;
 * - l'initialisation des variables de session.
 */
class User extends CRUD
{
    /**
     * Nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * Clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Champs autorisés lors des opérations
     * d'insertion et de mise à jour.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'privilege_id',
        'client_id'
    ];

    /**
     * Génère une version hachée d'un mot de passe
     * avant son enregistrement dans la base de données.
     *
     * Utilise l'algorithme BCrypt afin d'assurer
     * un stockage sécurisé des mots de passe.
     *
     * @param string $password Mot de passe à hacher.
     * @param int $cost Coût de l'algorithme BCrypt.
     * @return string Mot de passe haché.
     */
    public function hashPassword(
        string $password,
        int $cost = 10
    ): string {

        $options = [
            'cost' => $cost
        ];

        return password_hash(
            $password,
            PASSWORD_BCRYPT,
            $options
        );
    }

    /**
     * Vérifie les informations de connexion d'un utilisateur.
     *
     * Recherche l'utilisateur à partir de son nom
     * d'utilisateur puis compare le mot de passe fourni
     * avec celui enregistré dans la base de données.
     *
     * En cas de succès, initialise les variables
     * de session nécessaires à l'application.
     *
     * @param string $username Nom d'utilisateur.
     * @param string $password Mot de passe saisi.
     * @return bool Vrai si l'authentification réussit,
     *              faux sinon.
     */
    public function checkUser(
        string $username,
        string $password
    ): bool {

        $user = $this->unique(
            'username',
            $username
        );

        if ($user) {

            if (
                password_verify(
                    $password,
                    $user['password']
                )
            ) {

                /**
                 * Régénère l'identifiant de session
                 * pour prévenir les attaques de fixation
                 * de session.
                 */
                session_regenerate_id(true);

                /**
                 * Initialise les informations de session
                 * de l'utilisateur connecté.
                 */
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['client_id'] = $user['client_id'];

                return true;
            }
        }

        return false;
    }
}