<?php
session_start();
include "db.php";
if(isset($_POST['login'])) {
  $myusername = $_POST['usname'];
  $mypassword = md5($_POST['pass']); 
  $query = "SELECT * FROM guest WHERE usname = '$myusername'";
  $data = $koneksi->query($query);

  foreach($data as $row) {
    if ($myusername != $row['usname']) {
      echo "<script type='text/javascript'> alert('Password salah!')</script>";
    }
    if(($myusername == $row['usname']) && ($mypassword == $row['pass'])) {
        $_SESSION['guest'] = $myusername;
        $_SESSION['pass'] = $mypassword;
        if(isset($_POST['remember'])) {
            setcookie('usname', $myusername, time()+3600, '/');
            setcookie('pass', $mypassword, time()+3600, '/');
        }
        header("Location: index.php");
      } else {
          echo "<script type='text/javascript'> alert('Password salah!')</script>";
        }
      }

}if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $verifikasi_password = $_POST['verif'];
        $pattern = '/^(?=.*[A-Z])(?=.*[0-8])/';
        if (strlen($password) < 7) {
          echo "<script type='text/javascript'> alert('Password minimal harus terdiri dari 8 karakter!')</script>";
          }
          elseif ($password != $verifikasi_password) {
            echo "<script type='text/javascript'> alert('Password tidak sama!')</script>";
          }else {
            if (preg_match($pattern, $password)) {
              $username = $_POST['username'];
              $query = "SELECT * FROM guest WHERE usname='$username'";
              $result = $koneksi->query($query);
              if ($result->num_rows > 0) {
                echo "<script type='text/javascript'> alert('Username sudah digunakan!')</script>";
              }else {
                $password = md5($password);
                $verifikasi_password = md5($verifikasi_password);
                $query = "INSERT INTO guest (`usname`, `pass`)
                VALUES ('$username' , '$password')";
                if ($koneksi->query($query) === TRUE) {
                  echo "<script type='text/javascript'> alert('Data berhasil Ditambahkan')</script>";
                }
              }
            } else {
              echo "<script type='text/javascript'> alert('Password harus unik!')</script>";
            }
          }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="shortcut icon" href="admin/assets/img/monggo.png">
  <link rel="stylesheet" href="css/loginn.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form method="POST" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" id="username" name="usname" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" id="password" name="pass" />
          </div>
          <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>

            <div class="form-group">
                <div class="g-recaptcha center" style="width: 100px;"
                    data-sitekey="6Lf6LY4UAAAAACWFL1rBFg_StXqwJNBSHjYx3dvX"></div>
            </div>
          <div class="">
            <input type="submit" value="Login" class="btn" name="login" />
          </div>
          <div>
            <h5><a href="admin/index.php" class="nav-link">Login as Admin</a></h5>
          </div>
          <p class="social-text">Or Sign in with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>

        <button class="btn btn-secondary" style="display: flex; margin: auto; justify-content: center; align-items: center" id="sign-up-btn">
          Sign up
        </button>

        <form method="POST" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" />
          </div>
          <div class="input-field">
            <i class="fas fa-user-lock"></i>
            <input type="password" placeholder="Repeat Password" name="verif" />
          </div>
          <div>
            <input type="submit" class="btn" value="Submit" name="submit" id="submit" />
          </div>
          <div>
            <h5><a href="admin/index.php">Login as Admin</a></h5>
          </div>
          <p class="social-text">Or Sign up with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>

        <button class="btn btn-secondary hide" style="display: flex; margin: auto; justify-content: center; align-items: center" id="sign-in-btn">
          Sign in
        </button>

      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
        </div>
      </div>
      <div class="panel right-panel">
        <div class="content">
        </div>
      </div>
    </div>
  </div>
  <script src="js/app.js"></script>
  <!-- JS Scripts-->
  <!-- jQuery Js -->
  <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- Metis Menu Js -->
  <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
  <script src="assets/js/custom-scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</body>

</html>