<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de voitures</title>

    <link rel="stylesheet" href="{{ asset }}/css/style.css">
</head>

<body class="home">

    <div class="overlay"></div>

    <div class="home-top">

        <h1 class="home-title">
            Location de voitures
        </h1>

        {% if not isConnected %}

            <p class="home-subtitle">
                Bienvenue sur notre plateforme de location de voitures
            </p>

        {% else %}

            <p class="home-subtitle">
                Bienvenue {{ user_name }}
            </p>

        {% endif %}

    </div>

    <div class="home-bottom">

        {# Visiteur #}
        {% if not isConnected %}

            <nav class="home-menu">

                <a href="{{ base }}/login" class="btn">
                    Connexion
                </a>

                <a href="{{ base }}/register" class="btn">
                    Inscription
                </a>

            </nav>

        {# Administrateur #}
        {% elseif privilege_id == 1 %}

            <nav class="home-menu">

                <a href="{{ base }}/clients" class="btn">
                    Clients
                </a>

                <a href="{{ base }}/voitures" class="btn">
                    Voitures
                </a>

                <a href="{{ base }}/reservations" class="btn">
                    Réservations
                </a>

                <a href="{{ base }}/logs" class="btn">
                    Journal
                </a>

                <a href="{{ base }}/logout" class="btn">
                    Déconnexion
                </a>

            </nav>

        {# Client #}
        {% elseif privilege_id == 2 %}

            <nav class="home-menu">

                <a href="{{ base }}/catalogue" class="btn">
                    Catalogue
                </a>

                <a href="{{ base }}/mes-reservations" class="btn">
                    Mes réservations
                </a>

                <a href="{{ base }}/logout" class="btn">
                    Déconnexion
                </a>

            </nav>

        {% endif %}

    </div>

</body>
</html>