<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations</title>

    <link rel="stylesheet" href="{{ asset }}/css/style-global.css">
</head>
<body>

    <h1>Mes réservations</h1>

    {% if reservations %}

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Voiture</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Statut</th>
                </tr>
            </thead>

            <tbody>

                {% for reservation in reservations %}

                    <tr>

                        <td>
                            {{ reservation.id }}
                        </td>

                        <td>
                            {{ reservation.client_id }}
                        </td>

                        <td>
                            {{ reservation.voiture_id }}
                        </td>

                        <td>
                            {{ reservation.date_debut }}
                        </td>

                        <td>
                            {{ reservation.date_fin }}
                        </td>

                        <td>
                            {{ reservation.statut }}
                        </td>

                    </tr>

                {% endfor %}

            </tbody>

        </table>

    {% else %}

        <p>
            Aucune réservation trouvée.
        </p>

    {% endif %}

    <br>

    <a href="{{ base }}/home">
        Retour à l'accueil
    </a>

</body>
</html>