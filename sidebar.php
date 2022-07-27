<?php 
  // session_start();
  if(isset($_SESSION['librarian'])) {
    echo "<script>console.log('Welcome Librarian" .$_SESSION['librarian']."');</script>";
  }
  else {
    echo "<script>window.location.href='login.php';</script>";
  }
 ?>
<div class="sidebar close">
  <div class="logo-details">
    <i class='bx bx-library'></i>
    <span class="logo_name"> Library </span>
  </div>
  <ul class="nav-links">
    <li>
      <a href="dashboard.php">
        <i class='bx bxs-home'></i>
        <span class="link_name">Home</span>
      </a>
      <ul class="sub-menu blank">
        <li><a class="link_name" href="dashboard.php">Home</ua>
        </li>
      </ul>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class='bx bxs-book'></i>
          <span class="link_name">Book</span>
        </a>
        <i class='bx bxs-chevron-down arrow' onclick="toggleArrow()"></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="#">Book</a></li>
        <li><a href="addbook.php">Add Book</a></li>
        <li><a href="viewbooks.php">View Books</a></li>
      </ul>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class='bx bxs-book-bookmark'></i>
          <span class="link_name">Issue Book </span>
        </a>
        <i class='bx bxs-chevron-down arrow' onclick="toggleArrow()"></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="#">Issue Book</a></li>
        <li><a href="issuebook.php">Issue New Book</a></li>
        <li><a href="viewissuedbooks.php">View Issue Book</a></li>
      </ul>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class='bx bxs-user-check'></i>
          <span class="link_name">Student Report </span>
        </a>
        <i class='bx bxs-chevron-down arrow' onclick="toggleArrow()"></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="">Student Report</a></li>
        <li><a href="registerStudent.php">Register Student</a></li>
        <li><a href="viewstudents.php">View Students</a></li>
      </ul>
    </li>
  </ul>
</div>