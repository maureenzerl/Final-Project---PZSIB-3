  <!-- connection antara project dan database -->
  <?php
    $servername = "localhost";
    $database   = "final_project";
    $username   = "root";
    $password   = "";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>