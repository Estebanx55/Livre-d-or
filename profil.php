<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    session_start();

    if ($_SESSION["login"] == null) {
        header("location: index.php");
    }

    echo '<h2>Modifier votre profil</h2>';

    $connexion = mysqli_connect('localhost', 'root');
    mysqli_select_db($connexion, 'livreor');

    $loginCookieValue = isset($_SESSION['login']) ? $_SESSION['login'] : null;

    if (isset($_SESSION["login"])) {
        $command = "SELECT * FROM utilisateursOr WHERE login = '$loginCookieValue'";
        $result = mysqli_query($connexion, $command);

        echo "<table>";
        echo "<tr>";
        while ($fieldInfo = mysqli_fetch_field($result)) {
            echo "<th>" . $fieldInfo->name . "</th>";
        }
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            // Traitement du formulaire de modification de profil
    
            if ($_POST["password"] == "") {

                // Mettez à jour les informations dans la base de données
                // Réaffichez la page avec les nouvelles informations
            } else {
                $passwordCommand = $_POST['password'];
                $confirmPasswordCommand = $_POST['confirmpassword'];
                if ($confirmPasswordCommand === $passwordCommand) {
                    $loginCookieValue = isset($_SESSION['login']) ? $_SESSION['login'] : null;
                    $variablePasswordPost = $_POST["password"];
                    $commandPassword = "UPDATE utilisateursOr SET password ='$variablePasswordPost' WHERE login ='$loginCookieValue'";
                    $result = mysqli_query($connexion, $commandPassword);
                    header("location: profil.php");

                } else {
                    $error = "<p class='error'>Les deux mots de passe ne correspondent pas</p>";
                    echo $error;
                }
            }
            if ($_POST["login"] == "") {
            } else {
                $select = mysqli_query($connexion, "SELECT * FROM utilisateursOr WHERE login = '" . $_POST['login'] . "'");
                if (mysqli_num_rows($select)) {
                    echo "<p class='error'>Ce login est utilisé</p>";
                } else {
                    $loginCookieValue = isset($_SESSION['login']) ? $_SESSION['login'] : null;
                    $variableLoginPost = $_POST["login"];
                    $commandLogin = "UPDATE utilisateursOr SET login ='$variableLoginPost' WHERE login ='$loginCookieValue'";
                    $result = mysqli_query($connexion, $commandLogin);
                    $_SESSION["login"] = $variableLoginPost;
                    header("location: profil.php");
                }
            }
        }
    }
    if (isset($_POST["submit"])) {
        if (empty($_POST["login"]) and empty($_POST["prenom"]) and empty($_POST["nom"]) and empty($_POST["password"])) {
            echo '<p class="error">Veillez renseigner un champ</p>';
        }
    }

    if (isset($_POST['deco'])) {
        session_destroy();
        header('location: index.php');
        exit;
    }

    if ($loginCookieValue == "admin") {
        echo '<a class="ad1" href="admin.php"><button>Admin</button></a>';
    }
    ?>

    <form method="post" action="">
        <label for="last-name">Login:</label>
        <input type="text" id="login" name="login">

        <label for="password-register">Mot de passe:</label>
        <input type="password" id="password" name="password">

        <!-- Corrected typo in the following two lines -->
        <label for="confirmpassword-register">Confirmation mot de passe:</label>
        <input type="password" id="confirmpassword" name="confirmpassword">

        <button class="ad" type="submit" name="submit">Modifier</button>

    </form>

    <form method="post">
        <input class="deco" type="submit" name="deco" value="Deconnexion">
    </form>

    <a href="index.php"><button>Accueil</button></a>
</body>

</html>