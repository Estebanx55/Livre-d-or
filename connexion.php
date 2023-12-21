<?php
session_start();
include('header.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="container">
        <h2>Connexion</h2>
        <form method="post" action="connexion.php">
            <!-- Formulaire de connexion avec les champs "login" et "password" -->
            <label for="last-name">Login:</label>
            <input type="text" id="login" name="login" required>

            <label for="password-register">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="submit">Se connecter</button>
        </form>

        <div class="inscrip"><a href="inscription.php">Pas encore inscrit ? Inscrivez-vous !</a></div>
    </div>
</body>

</html>

<?php
// Insérer le code de connexion à la base de données ici
$connexion = mysqli_connect('localhost', 'root');
mysqli_select_db($connexion, 'livreor');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement du formulaire de connexion
    if (isset($_POST["submit"])) {
        $select = mysqli_query($connexion, "SELECT * FROM utilisateursOr WHERE login = '" . $_POST['login'] . "'");

        if (mysqli_num_rows($select)) {

            $select = mysqli_query($connexion, "SELECT * FROM utilisateursOr WHERE password = '" . $_POST['password'] . "'");
            if (mysqli_num_rows($select)) {
                $monCookie = $_POST['login'];
                $sql = "SELECT id_utilisateur FROM utilisateursOr WHERE login = '$monCookie';";
                $resultId = mysqli_query($connexion, $sql);
                $stringId = mysqli_fetch_assoc($resultId);
                $str = $stringId["id_utilisateur"];
                $_SESSION["id"] = $str;
                $_SESSION["login"] = $monCookie;
                header("location: index.php");
            } else {
                echo "<div id='error'><p class='error'>Le mot de passe est faux</p></div>";
                // Vérifiez les informations de connexion et créez la session si les informations sont correctes
                // Redirigez l'utilisateur vers la page de profil si la connexion réussit
            }
        } else {
            echo "<p class='error'>Le login n'existe pas</p>";
        }

    }
}
?>