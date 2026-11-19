<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Catalogue des voitures</title>

    <link rel="stylesheet"
          href="{{ asset }}/css/style-global.css">
</head>

<body>

    <h1>Catalogue des voitures</h1>

    <div class="catalogue">

        <div class="car-card">

            <img
                src="{{ asset }}/images/toyotaCorolla.jpg"
                alt="Toyota Corolla"
            >

            <h2>Toyota Corolla</h2>

            <p>Année : 2023</p>

            <p>Prix : 50 $ / jour</p>

            <a
                href="{{ base }}/reservation/create?id=1"
                class="btn"
            >
                Réserver
            </a>

        </div>

        <div class="car-card">

            <img
                src="{{ asset }}/images/hondaCivic.jpg"
                alt="Honda Civic"
            >

            <h2>Honda Civic</h2>

            <p>Année : 2024</p>

            <p>Prix : 55 $ / jour</p>

            <a
                href="{{ base }}/reservation/create?id=2"
                class="btn"
            >
                Réserver
            </a>

        </div>

        <div class="car-card">

            <img
                src="{{ asset }}/images/lamborgini.jpg"
                alt="Tesla Model 3"
            >

            <h2>Tesla Model 3</h2>

            <p>Année : 2024</p>

            <p>Prix : 120 $ / jour</p>

            <a
                href="{{ base }}/reservation/create?id=3"
                class="btn"
            >
                Réserver
            </a>

        </div>

    </div>

    <br>

    <a href="{{ base }}/home">
        Retour à l'accueil
    </a>

</body>

</html>