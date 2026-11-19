<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle réservation</title>

    <link rel="stylesheet" href="{{ asset }}/css/style-global.css">
</head>

<body>

<div class="container">

    <form
        action="{{ base }}/reservation/create"
        method="post"
    >

        <h2>Nouvelle réservation</h2>

        <label>
            Voiture

            <select name="voiture_id" required>

                <option value="">
                    Sélectionner une voiture
                </option>

                {% for voiture in voitures %}

                    <option
                        value="{{ voiture.id }}"

                        {% if reservation.voiture_id|default(voiture_id|default('')) == voiture.id %}
                            selected
                        {% endif %}
                    >
                        {{ voiture.marque }}
                        {{ voiture.modele }}
                        ({{ voiture.immatriculation }})
                    </option>

                {% endfor %}

            </select>

            {% if errors.voiture_id %}
                <span class="error">
                    {{ errors.voiture_id }}
                </span>
            {% endif %}

        </label>

        <label>
            Date début

            <input
                type="date"
                name="date_debut"
                value="{{ reservation.date_debut|default('') }}"
                required
            >

            {% if errors.date_debut %}
                <span class="error">
                    {{ errors.date_debut }}
                </span>
            {% endif %}

        </label>

        <label>
            Date fin

            <input
                type="date"
                name="date_fin"
                value="{{ reservation.date_fin|default('') }}"
                required
            >

            {% if errors.date_fin %}
                <span class="error">
                    {{ errors.date_fin }}
                </span>
            {% endif %}

        </label>

        <label>
            Statut

            <select name="statut">

                <option value="en_attente">
                    En attente
                </option>

                <option value="confirmee">
                    Confirmée
                </option>

                <option value="annulee">
                    Annulée
                </option>

            </select>

        </label>

        <input
            type="submit"
            class="btn"
            value="Enregistrer"
        >

    </form>

    <a
        href="{{ base }}/catalogue"
        class="btn"
    >
        Retour au catalogue
    </a>

</div>

</body>
</html>