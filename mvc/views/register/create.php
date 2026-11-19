<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <link rel="stylesheet" href="{{ asset }}/css/style-global.css">
</head>

<body>

    <div class="container">

        <h1>Inscription</h1>

        <form method="post">

            <div>
                <label for="nom">Nom</label>

                <input
                    type="text"
                    id="nom"
                    name="nom"
                    value="{{ user.nom }}"
                >

                <span class="error">
                    {{ errors.nom }}
                </span>
            </div>

            <div>
                <label for="prenom">Prénom</label>

                <input
                    type="text"
                    id="prenom"
                    name="prenom"
                    value="{{ user.prenom }}"
                >

                <span class="error">
                    {{ errors.prenom }}
                </span>
            </div>

            <div>
                <label for="telephone">Téléphone</label>

                <input
                    type="text"
                    id="telephone"
                    name="telephone"
                    value="{{ user.telephone }}"
                >
            </div>

            <div>
                <label for="email">Courriel</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ user.email }}"
                >

                <span class="error">
                    {{ errors.email }}
                </span>
            </div>

            <div>
                <label for="username">
                    Nom d'utilisateur
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ user.username }}"
                >

                <span class="error">
                    {{ errors.username }}
                </span>
            </div>

            <div>
                <label for="password">
                    Mot de passe
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                >

                <span class="error">
                    {{ errors.password }}
                </span>
            </div>

            <button type="submit">
                S'inscrire
            </button>

        </form>

        <p>
            Déjà inscrit ?
            <a href="{{ base }}/login">
                Se connecter
            </a>
        </p>

        <p>
            <a href="{{ base }}/home">
                Retour à l'accueil
            </a>
        </p>

    </div>

</body>

</html>