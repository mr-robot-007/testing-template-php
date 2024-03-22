<?php 
include 'config/constants.php';
const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);

if (isset($_POST["email"]) && isset($_POST["password"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  // echo $email , $password;
  $sql_query = "SELECT * from demo_table WHERE email='$email' AND password='$password'";
  $result = conn->query($sql_query)->fetch_assoc();
  // print_r($result);
  if ($result) {
      // $_SESSION["user"] = $result["profile_pic"];
      $_SESSION["user"] = array(
          "username" => $result["username"],
          "email"=> $result["email"],
          "uid" => $result["id"],
          "profile_pic" => $result["profile_pic"],
          "type" => $result["type"],
      );
      header("Location:index.php");
  }
}
?>

<link rel="stylesheet" href="index.css" />

<div class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="login.php" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>




      </div>
      <!-- /.login-card-body -->
    </div>
  </div>

</div>