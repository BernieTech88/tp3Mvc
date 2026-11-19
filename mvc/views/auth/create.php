<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset }}/css/style-global.css">
</head>
<body>

<div class="container">

    <form action="{{ base }}/login" method="post">

        <h2>Connexion</h2>

        {% if errors.message %}
            <span class="error">
                {{ errors.message }}
            </span>
        {% endif %}

        <label>
            Nom d'utilisateur

            <input
                type="text"
                name="username"
                value="{{ user.username|default('') }}"
                required
            >

            {% if errors.username %}
                <span class="error">
                    {{ errors.username }}
                </span>
            {% endif %}
        </label>

        <label>
            Mot de passe

            <input
                type="password"
                name="password"
                required
            >

            {% if errors.password %}
                <span class="error">
                    {{ errors.password }}
                </span>
            {% endif %}
        </label>

        <input
            type="submit"
            class="btn"
            value="Se connecter"
        >

    </form>

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