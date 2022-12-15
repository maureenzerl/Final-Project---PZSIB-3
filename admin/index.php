<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Exclusive News</title>
</head>

<body class="bg-dark p-5">
    <?php
    session_start();

    if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
        header("location:/finalProject/admin/dashboard.php");
    }

    include '../connect.php';

    if (isset($_POST['username']) && $_POST['password']) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admins WHERE username='$username' and password='$password'";
        $data = $conn->query($sql);

        $check = mysqli_num_rows($data);

        if (isset($_POST['submit'])) {
            if ($check != 0) {
                $_SESSION['username'] = $username;
                $_SESSION['status'] = "login";
                header("location:/finalProject/admin/dashboard.php");
            } else {
                $_SESSION['error'] = "Login failed, please check Your username and password!";
            }
        }
    }
    ?>
    <main class="container-fluid mx-auto">
        <h3 class="text-center p-2">
            <a href="../index.php">
                <img src="../assets/logo2.png" alt="">
            </a>
        </h3>
        <br>
        <div class="card mx-auto cards1 p-5 bg-light">
            <h2 class="mx-auto text-dark">Login</h2>
            <h4 class="mx-auto text-dark">Welcome Back!</h4>
            <hr>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Username</label>
                        <input type="text" class="form-control single-input bg-light" id="username" name="username" placeholder="Username or email" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label text-dark">Password</label>
                        <input type="password" class="form-control single-input bg-light" id="password" name="password" placeholder="Password" autocomplete="off" required>
                    </div>
                    <p class="mt-2 text-center text-danger" style="font-size: 12px;">
                        <?php if (isset($_SESSION['error'])) {
                            echo ($_SESSION['error']);
                        } ?>
                    </p>
                    <br>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary px-5 w-100 fw-bold btnlogin">Login</button>
                    </div>
                    <br>
                    <div id="emailHelp" class="form-text text-center mb-4 text-dark">
                        <a href="../index.php" class="text-dark fw-bold options">Back to Homepage &nbsp<i class="fa-solid fa-house"></i> </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php
    unset($_SESSION['error']);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>