<?php 
  session_start();
  if(isset($_SESSION['librarian'])) {
    echo "<script>console.log('Welcome Librarian" .$_SESSION['librarian']."');</script>";
  }
  else {
    echo "<script>window.location.href='login.php';</script>";
  }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="script.js"></script>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <?php include 'sidebar.php' ?>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' onclick="toggleSidebar()"></i>
      <span class="text">Library Management System</span>
    </div>
    <div class="Student-registration-form">
      <div class="card m-auto mt-5" style="width: 600px; border-radius: 1%; color: #fff; background-color: #11101d;">
        <div class="card-header text-center">
          <p style="font-size: 25px; font-weight: bold; padding-top: 10px"> Issue New Book </p>
        </div>

        <div class="card-body">
          <form action="" method="POST">

            <div class="m-3">
              <label for="input1" class="form-label">Student Name</label>
              <?php
              $conn = mysqli_connect("localhost", "root", "", "lms");
              $qresult = mysqli_query($conn, 'select id, studentname from students');
              echo "<select class='form-select' id='input1' name='issuestudent'>";
              echo "<option selected>Select Student Name</option>";
              while ($row = mysqli_fetch_array($qresult)) {
                echo "<option value='" . $row['studentname'] . "'>" . $row['studentname'] . "</option>";
              }
              ?>
            </div>
            <div class="m-3">
              <label for="input3" class="form-label">Jugaad</label>
              <input type="hidden" name="jugaad" class="form-control" id="input3" placeholder="Jugaad Here ..." />
            </div>
              
            <div class="m-3">
              <label for="input2" class="form-label">Book Name</label>
              <?php
              $conn = mysqli_connect("localhost", "root", "", "lms");
              $qresult = mysqli_query($conn, 'select id, bookname from books');
              echo "<select class='form-select' id='input2' name='issuedbook'>";
              echo "<option selected>Select Book Name</option>";
              while ($row = mysqli_fetch_array($qresult)) {
                echo "<option value='" . $row['bookname'] . "'>" . $row['bookname'] . "</option>";
              }
              ?>
            </div>
            <div class="m-3">
              <label for="input4" class="form-label">Jugaad Two</label>
              <input type="hidden" name="jugaadtwo" class="form-control" id="input4" placeholder="Jugaad Here ..." />
            </div>
            <div class="m-3">
              <label for="input3" class="form-label">Issue Date</label>
              <input type="date" name="issuedate" class="form-control" id="input3" placeholder="Issue Date here..." />
            </div>
            <div class="mb-3">
              <button class="btn btn-outline-danger" type="submit" name="submit" style="width: 100%;"> Issue </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>

<?php
  $conn = mysqli_connect("localhost", "root", "", "lms");
  if(isset($_POST['submit'])) {
    $issuestudent = $_POST['issuestudent'];
    $issuebook = $_POST['issuedbook'];
    $issuedate = $_POST['issuedate'];
    $query = "insert into issued_details(studentname, bookname, issuedate) 
    values('$issuestudent','$issuebook','$issuedate')";
    mysqli_query($conn, $query);
    echo "<script>alert('Successfully Issued A Book')</script>";
  }
?>