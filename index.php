<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>


<?php
include('header.php');
?>

<body>
    <h2>Bienvenue sur le site de Esteban ☻ </h2>
    <p>Contenu de la page d'accueil. ..</p>
    <?php

    if (isset($_SESSION["login"])) {
        echo '<form method="post" action="index.php"><button type="submit" name="submit">Profil</button></form>';
        if (isset($_POST['submit'])) {
            header('location: profil.php');
        }

    } else {
        echo '<a href="inscription.php"><button>Inscription</button></a>';
    }

    if (isset($_SESSION["login"])) {
        echo '<div class="sar"><a href="commentaire.php"><button>Ajouter un commentaire!</button></a></div>';
    }
    ?>

    <div class="sar"><a href="livre-or.php"><button>Livre d'or</button></a></div>


</body>

</html>