<?php
require_once 'dbConfig.php';
$var = getenv('PASS');
if (isset($_POST['login'])) {
  $salt = $var;
  $pass = hash('sha256', $_POST['password'] . $salt);

  //FOR REGISTRATION
  $sql = $conn->query("INSERT INTO login (name,password) VALUES ('" . $_POST['email'] . "', '$pass')");
  echo "<p class='display-4 text-center text-danger'>Successfully Registered</p>";
}
?>

<div>
  <h1 class="text-center display-2">Login</h1>
  <form action="" method="post" class="container jumbotron" style="max-width: 50%;">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <input type="submit" value="Register" name="login" class="btn btn-primary" style="margin-left: 50%;transform:transateX(-50%);">
  </form>
</div>