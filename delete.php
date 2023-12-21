<?php
session_start();
if (isset($_SESSION['login'])) {
  echo '<h1>Bonjour ' . $_SESSION['login'] . '</h1>';
}

?>
<?php
$connexion = mysqli_connect('localhost', 'root');
mysqli_select_db($connexion, 'livreor');
$id = 0;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
if (!empty($_POST)) {
  $id = (int) $_POST['id'];
  $sql = "DELETE FROM commentaires  WHERE id = '$id'";
  $result = mysqli_query($connexion, $sql);
  header("Location: livre-or.php");

}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
    data-wp-preserve="%3Cscript%20src%3D%22js%2Fbootstrap.min.js%22%3E%3C%2Fscript%3E" data-mce-resize="false"
    data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="<script>" title="<script>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
  <div class="container">
    <div class="span10 offset1">
      <div class="row">
        <h3>Delete a comment</h3>
      </div>
      <form class="form-horizontal" action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        Are you sure to delete ?
        <div class="form-actions">
          <button type="submit" class="btn btn-danger">Yes</button>
          <a class="btn" href="livre-or.php">No</a>
        </div>
      </form>
    </div>
  </div>
  <!-- /container -->
</body>

</html>