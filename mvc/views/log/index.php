<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal de bord</title>

    <link rel="stylesheet" href="{{ asset }}/css/style-global.css">
</head>
<body>

<div class="container">

    <h2>Journal de bord</h2>

    {% if logs %}

        <table>

            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Adresse IP</th>
                    <th>Page visitée</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

                {% for log in logs %}

                    <tr>
                        <td>
                            {{ log.username }}
                        </td>

                        <td>
                            {{ log.ip_address }}
                        </td>

                        <td>
                            {{ log.page }}
                        </td>

                        <td>
                            {{ log.created_at }}
                        </td>
                    </tr>

                {% endfor %}

            </tbody>

        </table>

    {% else %}

        <p>Aucune entrée dans le journal.</p>

    {% endif %}

    <a
        href="{{ base }}/home"
        class="btn"
        style="margin-top:15px;"
    >
        Retour
    </a>

</div>

</body>
</html>