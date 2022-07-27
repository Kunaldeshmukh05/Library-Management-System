<?php
session_start();
if (isset($_SESSION['librarian'])) {
  echo "<script>console.log('Welcome Librarian" . $_SESSION['librarian'] . "');</script>";
} else {
  echo "<script>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DashBoard</title>
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
      <div style="margin-left: 750px;">
        <label for="username">
          <?php 
          // session_start();
          echo "" . $_SESSION['librarian'];
          ?>
        </label>
      </div>
      <div style="margin-left: 30px;">
        <span>
          <a href="logout.php" class="btn" style="background-color:#11101d; color: white;">Logout</a>
        </span>
      </div>
    </div>
    <!-- Cards -->
    <div class="row">
      <div class="col-sm-4">
        <div class="card" style="width: 400px; height: 150px; margin: 50px; border-radius: 3%;">
          <div class="card-header text-center">
            <label for="header" style="font-size:1.25rem;">Total Books</label>
          </div>
          <div class="card-body text-center">
            <label for="count" style="font-size:1.25rem;">
              <?php
              $conn = mysqli_connect("localhost", "root", "", "lms");
              $query = 'select count(bookname) from books';
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_array($result);
              $total = $row[0];
              echo "" . $total;
              ?>
            </label>
          </div>
        </div>
      </div>
      <div class=" col-sm-4">
        <div class="card" style="width: 400px; height: 150px; margin: 50px; border-radius: 3%;">
          <div class="card-header text-center">
            <label for="header" style="font-size:1.25rem;">Total Issued Books</label>
          </div>
          <div class="card-body text-center">
            <label for="count" style="font-size:1.25rem;">
              <?php
              $conn = mysqli_connect("localhost", "root", "", "lms");
              $query = 'select count(*) from issued_details';
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_array($result);
              $total = $row[0];
              echo "" . $total;
              ?>
            </label>
          </div>
        </div>
      </div>
      <div class=" col-sm-4">
        <div class="card" style="width: 400px; height: 150px; margin: 50px; border-radius: 3%;">
          <div class="card-header text-center">
            <label for="header" style="font-size:1.25rem;">Total Students</label>
          </div>
          <div class="card-body text-center">
            <label for="count" style="font-size:1.25rem;">
              <?php
              $conn = mysqli_connect("localhost", "root", "", "lms");
              $query = 'select count(*) from students';
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_array($result);
              $total = $row[0];
              echo "" . $total;
              ?>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class=" row" style="margin-left:40px">
      <div class="col-md-5">
        <label for="Student" style="font-size:1.25rem; font-weight: 400;"> Student
        </label>
        <hr>
        <div class="card p-3">
          <div class="card-hrader">
            <div class="d-grid gap-2">
              <a href="registerStudent.php" class="btn btn-primary"> Register </a>
            </div>
          </div>
          <div class="card-body">
            <table class="table">
              <tr>
                <th>Id</th>
                <th>Student Name </th>
                <th>Student Branch </th>
              </tr>
              <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "lms");
                $qresult = mysqli_query($conn, 'select id, studentname, studentbranch from students');
                while ($row = mysqli_fetch_array($qresult)) {
                  echo "<tr>";
                  // echo "<td>";
                  // echo "<a href='#' class='btn btn-primary'> View </a>";
                  // echo "</td>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['studentname'] . "</td>";
                  echo "<td>" . $row['studentbranch'] . "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col" style="margin-right: 20px;">
        <label for="table" style="font-size:1.25rem; font-weight: 400;">
          Last 5 Issued Books </label>
        <hr>
        <div class="card p-3">
          <table class="table">
            <tr>
              <th>Student Name </th>
              <th>Student Book </th>
              <th>Issued date </th>
              <th>Return Date </th>
              <th>Status </th>
            </tr>
            <tbody>
              <?php
              $conn = mysqli_connect("localhost", "root", "", "lms");
              $qresult = mysqli_query($conn, 'select studentname, bookname, issuedate, returndate from issued_details order by id desc limit 5');
              while ($row = mysqli_fetch_array($qresult)) {
                echo "<tr>";
                echo "<td>" . $row['studentname'] . "</td>";
                echo "<td>" . $row['bookname'] . "</td>";
                echo "<td>" . $row['issuedate'] . "</td>";
                echo "<td>" . $row['returndate'] . "</td>";
                echo "<td>";
                echo "<button onclick='javascript: location.href=`viewissuedbooks.php`' class='btn btn-primary btn-sm'> 
              Update </button>";
                echo "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</body>

</html>