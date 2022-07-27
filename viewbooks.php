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
    <div class="card mt-5" style="margin-left: 70px; margin-right: 30px; background-color: #e4e9f7;">
      <div class="card-header">
        <div style="display: flex;">
          <p class="float-start" style="font-size: 25px; font-weight: bold; padding-top: 10px;">
            Books
          </p>
          <input class="form-control" id="search-input" type="text" placeholder="Search here .." style="margin-left:auto; width: 300px; height: 50px; padding-top: 10px;" aria-label="Search" onkeyup="search()">
        </div>
      </div>
      <div class="card-body">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Book Name</th>
              <th scope="col">Author Name</th>
              <th scope="col">Branch</th>
              <th scope="col">ISBN number</th>
              <th scope="col">Quantity</th>
              <th scope="col">Operation</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "lms");
            $qresult = mysqli_query($conn, 'select * from books');
            while ($row = mysqli_fetch_array($qresult)) {
              echo "<tr>";
              echo "<form action='deletebook.php' method='POST'>";
              echo "<th scope='row'>" . $row['id'] . "</th>";
              echo "<td>" . $row['bookname'] . "</td>";
              echo "<td>" . $row['authorname'] . "</td>";
              echo "<td>" . $row['branch'] . "</td>";
              echo "<td>" . $row['isbn'] . "</td>";
              echo "<td>" . $row['quantity'] . "</td>";
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
            <h5 class="modal-title" id="exampleModalLabel">Update Book Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST">
            <div class="modal-body">
              <input type="hidden" name="hiddenid" value="" id="hidid">
              <div class="m-3">
                <label for="input1" class="form-label">Book Name</label>
                <input type="text" name="bookname" class="form-control" id="input1" placeholder="Book name here..." />
              </div>
              <div class="m-3">
                <label for="input2" class="form-label">Author Name</label>
                <input type="text" name="authorname" class="form-control" id="input2" placeholder="Author name..." />
              </div>
              <div class="m-3">
                <label for="input3" class="form-label">Branch</label>
                <input type="text" name="branch" class="form-control" id="input3" placeholder="Branch here..." />
              </div>
              <div class="m-3">
                <label for="input4" class="form-label">ISBN Number</label>
                <input type="text" name="isbn" class="form-control" id="input4" placeholder="ISBN number here..." />
              </div>
              <div class="m-3">
                <label for="input5" class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control" id="input5" placeholder="Book Quantity..." />
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
      let filter = document.getElementById('search-input').value.toLowerCase();
      let tablerow = document.getElementById('myTable').getElementsByTagName('tr');
      for (var i = 0; i < tablerow.length; i++) {
        let tabledata = tablerow[i].getElementsByTagName('td')[0];
        if (tabledata) {
          let value = tabledata.textContent || tabledata.innerHTML;
          if (value.toLowerCase().indexOf(filter) > -1) {
            tablerow[i].style.display = '';
          } else {
            tablerow[i].style.display = 'none';
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
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $branch = $_POST['branch'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];
    $query = "update books set bookname='$bookname', authorname='$authorname',
    branch='$branch', isbn='$isbn', quantity='$quantity' where id=$id";
    mysqli_query($conn, $query);
    echo "<script>
            alert('Updated Book Details');
            window.location.href = 'viewbooks.php';
            </script>";
  }
?>