<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body style="background-color: #e0e0e0;">
  <div class="card mx-auto mt-5 shadow-lg p-2" style="width: 500px;">
    <div class="card-header">
        <p class="text-center" style="background-color: #eee; font-size: xx-large; font-weight:bolder;">Registration</p>
    </div>
    <div class="card-body" style="background-color: #F5F5F5;">
        <form action="" method="POST" class="form-group">
            <div class="m-3">
              <label for="input1" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="input1" placeholder="username here" style="background-color: inherit; border-color: #c0c0c0;">
            </div>
            <div class="m-3">
              <label for="input2" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="input2" placeholder="email here" style="background-color: inherit; border-color: #c0c0c0;">
            </div>
            <div class="m-3">
              <label for="input3" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="input3" placeholder="password here" style="background-color: inherit; border-color: #c0c0c0;">
            </div>
            <div class="m-3">
              <label for="input4" class="form-label">Confirm Password</label>
              <input type="password" name="confirmpass" class="form-control" id="input4" placeholder="confirm password here" style="background-color: inherit; border-color: #c0c0c0;">
            </div>
            <div class="m-3 d-grid">
                <button class="btn btn-primary" type="submit" name="submit"> Register </button>
            </div>
            <div class="text-center">
                <p>Already have Account, <a href="login.php" style="color: red; text-decoration: none; font-weight: bolder;">Login Here</a></p>
            </div>
        </form>
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
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpass'];
        $query = "insert into librarians(username, email, password, confirmpass)
        values('$username', '$email', '$password', '$confirmpassword')";
        mysqli_query($conn, $query);
        echo "<script>
            alert('Logged In To DashBoard');
            window.location.href = 'dashboard.php';
            </script>";
    }
?>