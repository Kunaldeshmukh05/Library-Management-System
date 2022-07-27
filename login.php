
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="script.js"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body style="background-color: #e0e0e0;">
<div class="card mx-auto mt-5 shadow-lg" style="width: 500px;">
    <div class="card-header" style="background-color: #eee; font-weight: bolder; text-align: center; font-size: x-large;">
        Login
    </div>
    <div class="card-body" style="background-color: #F5F5F5;">
        <form action="" method="POST">
            <div class="m-3">
              <label for="input1" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="input1" placeholder="username here" style="background-color: inherit; border-color: #c0c0c0;">
            </div>
            <div class="m-3">
              <label for="input2" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="input2" placeholder="password here" style="background-color: inherit; border-color: #c0c0c0;">
            </div>
            <div class="m-3 d-grid">
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <div class="text-center">
            <p>Don't have Account, <a href="register.php" style="color: red; text-decoration: none; font-weight: bolder;">Register Here</a></p>
        </div>
    </div>
</div>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
crossorigin="anonymous"></script>
</body>
</html>

<?php 
  
  $conn = mysqli_connect("localhost", "root", "", "lms");
  if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "select * from librarians where username='$username' and password='$password'";
    $result = mysqli_num_rows(mysqli_query($conn, $query));
    if($result == 1) {
      session_start();
      $_SESSION['librarian'] = $username;
      echo "<script> alert('Successfully logged in!');window.location.href = 'dashboard.php';</script>";
    }
    else {
      echo "<script> alert('please try again');window.location.href='login.php';</script>";
    }
  }
?>
