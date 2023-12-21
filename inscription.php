<?php
include('header.php'); 
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Inscription</h2>
    <form method="post" action="inscription.php">

        <label for="last-name">Login:</label>
        <input type="text" id="login" name="login" required>

        <label for="password-register">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <!-- Corrected typo in the following two lines -->
        <label for="confirmpassword-register">Confirmation mot de passe:</label>
        <input type="password" id="confirmpassword" name="confirmpassword" required>

        <button type="submit" name="submit">S'Inscrire</button>
    </form>

</body>

</html>


<?php
// Insérer le code de connexion à la base de données ici
$connexion = mysqli_connect('localhost', 'root');
mysqli_select_db($connexion, 'livreor');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $select = mysqli_query($connexion, "SELECT * FROM utilisateursOr WHERE login = '" . $_POST['login'] . "'");
        if (mysqli_num_rows($select)) {
            echo '<p class="error">Ce login est utilisé</p>';
        } else {
            $loginCommand = $_POST['login'];
            $passwordCommand = $_POST['password'];
            $confirmPasswordCommand = $_POST['confirmpassword'];
            // Traitement du formulaire d'inscription
            if ($confirmPasswordCommand === $passwordCommand) {
                $command = "INSERT INTO utilisateursOr(login, password) VALUES('$loginCommand', '$passwordCommand')";
                $result = mysqli_query($connexion, $command);
                // Insérez les données dans la base de données
                // Redirigez l'utilisateur vers la page de connexion
                header("location: connexion.php");
            } else {
                $error = '<p class="error">Les deux mots de passe ne correspondent pas</p>';
                echo $error;
            }
        }
    }
}
?>

<div><a href="connexion.php">Vous êtes déjà inscrit?</a></div>