<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['login'])) {
        echo '<a href="connexion.php"><p>Connectez-vous pour poster un commentaire</p></a>';
    }

    $connexion = mysqli_connect('localhost', 'root');
    mysqli_select_db($connexion, 'livreor');

    $sql = "SELECT * FROM commentaires NATURAL JOIN utilisateursOr ORDER BY date ASC;";
    $result = mysqli_query($connexion, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="comment">';
        echo '<h3>Utilisateur: ' . $row["login"] . '</h3>';
        echo '<p>Commentaire: ' . $row["commentaire"] . '</p>';
        echo '<p>Date: ' . $row["date"] . '</p>';
        $idSession = (int) $_SESSION['id'];
        $idUserComment = $row['id_utilisateur'];
        if ($idSession == $idUserComment) {
            echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . ' ">Delete</a>'; // un autre td pour le bouton de suppression
        }
        echo '</div>';
    }
    ?>

    <p>
        <?php echo isset($login) ? $login : ''; ?>
    </p>
    <a href="index.php"><button>Accueil</button></a>
</body>

</html>