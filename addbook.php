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
      <i class="bx bx-menu" onclick="toggleSidebar()"></i>
      <span class="text">Library Management System</span>
    </div>
    <div class="add-book">
      <div class="card m-auto mt-5" style="
            width: 600px;
            border-radius: 1%;
            color: #fff;
            background-color: #11101d;
          ">
        <div class="card-header text-center">
          <p style="font-size: 25px; font-weight: bold; padding-top: 10px">
            Add Book
          </p>
        </div>
        <div class="card-body">
          <form action="" method="POST" class="form-group">
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
              <label for="input4" class="form-label">Quantity</label>
              <input type="text" name="quantity" class="form-control" id="input4" placeholder="Book Quantity..." />
            </div>
            <div class="m-3 d-grid">
              <button class="btn btn-primary" type="submit" name="submit" style="width: 100%">
                Add
              </button>
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
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $branch = $_POST['branch'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];
    $query = "insert into books (bookname, authorname, branch, isbn, quantity)
    values('$bookname','$authorname', '$branch', '$isbn', $quantity)";
    mysqli_query($conn, $query);
    echo "<script>alert('Sucessfully Added A Book');</script>";  
  }
?>