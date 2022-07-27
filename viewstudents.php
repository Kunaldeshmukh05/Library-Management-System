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
  <title>View Students</title>
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
      <i class="bx bx-menu" onclick="toggleSidebar()"></i>
      <span class="text">Library Management System</span>
    </div>
    <div class="card mt-5" style="margin-left: 70px; margin-right: 30px; background-color: #e4e9f7">
      <div class="card-header">
        <div style="display: flex">
          <p class="float-start" style="font-size: 25px; font-weight: bold; padding-top: 10px">
            Students
          </p>
          <input class="form-control" id="search-input" type="text" placeholder="Search here .." style="
                margin-left: auto;
                width: 300px;
                height: 50px;
                padding-top: 10px;
              " aria-label="Search" onkeyup="search()" />
        </div>
      </div>
      <div class="card-body">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Branch</th>
              <th scope="col">Enrollment Number</th>
              <th scope="col">Operation</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "lms");
            $qresult = mysqli_query($conn, 'select * from students');
            while ($row = mysqli_fetch_array($qresult)) {
              echo "<tr>";
              echo "<form action='deletestudent.php' method='POST'>";
              echo "<th scope='row'>" . $row['id'] . "</th>";
              echo "<td>" . $row['studentname'] . "</td>";
              echo "<td>" . $row['studentemail'] . "</td>";
              echo "<td>" . $row['studentbranch'] . "</td>";
              echo "<td>" . $row['enrollment'] . "</td>";
              echo "<td>";
              echo "<button type='button' onclick='solve(this);' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#exampleModal'> 
              Update </button>";
              echo '<button type="submit" name="submit" value="'.$row['id'].'" class="btn btn-danger">Delete</button>';
              echo "</td>";
              echo "</form>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Student Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST">
            <div class="modal-body">
            <input type="hidden" name="hiddenid" value="" id="hidid">
              <div class="m-3">
                <label for="input1" class="form-label">Student Name</label>
                <input type="text" name="studentname" class="form-control" id="input1" placeholder="Student name here..." />
              </div>
              <div class="m-3">
                <label for="input2" class="form-label">Student Email</label>
                <input type="text" name="studentemail" class="form-control" id="input2" placeholder="Student Email here..." />
              </div>
              <div class="m-3">
                <label for="input3" class="form-label">Student Branch</label>
                <input type="text" name="studentbranch" class="form-control" id="input3" placeholder="Student Branch here..." />
              </div>
              <div class="m-3">
                <label for="input4" class="form-label">Enrollment Number</label>
                <input type="text" name="enrollmentnumber" class="form-control" id="input4" placeholder="Enrollment Number number here..." />
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-danger">Update</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script>
    function search() {
      let filter = document
        .getElementById("search-input")
        .value.toLowerCase();
      let tablerow = document
        .getElementById("myTable")
        .getElementsByTagName("tr");
      for (var i = 0; i < tablerow.length; i++) {
        let tabledata = tablerow[i].getElementsByTagName("td")[0];
        if (tabledata) {
          let value = tabledata.textContent || tabledata.innerHTML;
          if (value.toLowerCase().indexOf(filter) > -1) {
            tablerow[i].style.display = "";
          } else {
            tablerow[i].style.display = "none";
          }
        }
      }
    }
    function solve(e) {
      console.log(e.parentElement.parentElement.childNodes[1].innerText);
      var id = e.parentElement.parentElement.childNodes[1].innerText;
      hidid = document.getElementById('hidid');
      hidid.value = id;
    }
  </script>
</body>
</html>

<?php
    $conn = mysqli_connect("localhost", "root", "", "lms");
    if(isset($_POST['submit'])) {
        $id = $_POST['hiddenid'];
        $studentname = $_POST['studentname'];
        $studentemail = $_POST['studentemail'];
        $studentbranch = $_POST['studentbranch'];
        $enrollmentnumber = $_POST['enrollmentnumber'];
        $query = "update students set studentname='$studentname',
        studentemail='$studentemail', studentbranch='$studentbranch', 
        enrollment='$enrollmentnumber' where id='$id'";
        mysqli_query($conn, $query);
        echo "<script>
            alert('Updated Student Details - $id');
            window.location.href = 'viewstudents.php';
            </script>";
    }
?>