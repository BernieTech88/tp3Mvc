<?php

namespace App\Models;

/**
 * Représente les réservations enregistrées dans la base de données
 */
class Reservation extends CRUD
{
    /**
     * Nom de la table associée au modèle
     */
    protected $table = 'reservations';

    /**
     * Clé primaire de la table reservations
     */
    protected $primaryKey = 'id';

    /**
     * Liste des champs autorisés pour insert et update
     */
    protected $fillable = [
        'client_id',
        'voiture_id',
        'date_debut',
        'date_fin',
        'statut'
    ];

    /**
     * Retourne toutes les réservations d'un client
     *
     * @param int $clientId
     * @return array
     */
    public function findByClient(int $clientId): array
    {
        $sql = "
            SELECT *
            FROM reservations
            WHERE client_id = :client_id
            ORDER BY date_debut DESC
        ";

        $stmt = $this->prepare($sql);

        $stmt->bindValue(
            ':client_id',
            $clientId,
            \PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }
}