<?php
    $conn = mysqli_connect("localhost", "vibrant", "vibrant2001", "lms");
    if(isset($_POST['submit'])) {
    $id = $_POST['submit'];
    $query = "delete from books where id='$id'";
    mysqli_query($conn, $query);
    echo "<script>
        alert('Deleted Book Details - $id');
        window.location.href = 'viewbooks.php';
        </script>";
    }
?>