<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .commI {
            font-size: 18px;
            padding: 10px;
            /* Adjust the padding as needed */
            width: 80%; /* Adjust the width as needed */
        }
    </style>
</head>

<body class="commB">
    <form class="commF" method="post">
        <label for="Commentaire">Commentaire :</label>
        <input class="commI" name="Commentaire" rows="5">
        <input class="deco" type="submit" name="submit" value="Envoyer">
    </form>
    <div class="sar"><a href="index.php"><button>Accueil</button></a></div>
</body>

</html>

<?php
$connexion = mysqli_connect('localhost', 'root');
mysqli_select_db($connexion, 'livreor');

if (isset($_POST['submit'])) {
    $commentaire = htmlentities($_POST['Commentaire']);
    $strId = $_SESSION['id'];
    $id = (int) $strId;
    $sql = "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$commentaire', '$id', CURRENT_TIMESTAMP);";
    $result = mysqli_query($connexion, $sql);
    header("location: livre-or.php");
}
?>


