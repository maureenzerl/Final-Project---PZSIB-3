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

<body class="bg-dark">
    <?php
    session_start();

    if (isset($_SESSION['status']) != "login") {
        header("location:/finalProject/admin");
    }
    if (isset($_POST['submit1'])) {
        session_destroy();
        header("location:/finalProject/admin");
    }

    include '../../connect.php';

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $date = $_POST['date'];
        $image = $_POST['image'];
        $paragraph = $_POST['paragraph'];
        $author = $_POST['author'];
        $status = $_POST['status'];

        include_once '../../connect.php';
        $sql = "INSERT INTO news_details(title, category_id, date, image, paragraph, creator_id, status_id) 
                VALUES ('$title','$category','$date','$image','$paragraph','$author','$status');";
        $datas = $conn->query($sql);

        if (mysqli_affected_rows($conn) > 0) {
            header("Location:index.php");
        } else {
            $_SESSION['error'] = "Failed to update data!";
        }
    }

    $category_sql = "SELECT * FROM category_lists";
    $categories = $conn->query($category_sql);

    $author_sql = "SELECT * FROM creator_lists";
    $authors = $conn->query($author_sql);

    $status_sql = "SELECT * FROM news_status";
    $stats = $conn->query($status_sql);
    ?>

    <nav class="navbar navbar-light bg-dark p-3 navs">
        <img src="../../assets/logo2.png" style="width: 300px;" alt="">
        <div class="d-flex align-items-center">
            <div class="search-container">
                <form action="">
                    <input type="text" placeholder="Search.." name="search" class="bg-light" autocomplete="off">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="dropdown">
                <a class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo ($_SESSION['username']) ?> &nbsp; <i class="fa fa-lock"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li>
                        <form id="logout_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button class="dropdown-item">
                                Edit Profile
                            </button>
                            <button class="dropdown-item" type="submit" name="submit1">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-2 bg-dark mx-auto position-fixed">
                <h5 class="text-light text-center m-2"> Welcome, <?php echo ($_SESSION['username']) ?></h5>
                <div class="nav flex-column flex-nowrap vh-100 overflow-auto text-light p-2">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link fonts text-light" aria-current="page" href="/finalProject/admin/dashboard.php">
                                <i class="fa-solid fa-home px-2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fonts text-light" aria-current="page" href="/finalProject/admin/news/index.php">
                                <i class="fa-solid fa-newspaper px-2"></i>
                                <span class="t">News</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fonts text-light" aria-current="page" href="/finalProject/admin/categories/index.php">
                                <i class="fa-solid fa-box-archive px-2"></i>
                                <span class="">Category</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fonts text-light" aria-current="page" href="/finalProject/admin/authors/index.php">
                                <i class="fa-solid fa-user px-2"></i>
                                <span class="">Author</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fonts text-light" aria-current="page" href="/finalProject/admin/status/index.php">
                                <i class="fa-solid fa-circle-info px-2"></i>
                                <span class="">Status</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <main class="col-10 ms-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-labels="breadcrumb">
                    <ol class="breadcrumb brdcrumb fs-4">
                        <li class="breadcrumb-item fw-bold"><a class="text-light" href="/finalProject/admin/categories/index.php">News Details</a></li>
                        <li class="breadcrumb-item" aria-current="page">Add News Details</li>
                    </ol>
                </nav>
                <div class="row mt-5">
                    <div class="card bg-light text-dark ms-2" style="width: 90% !important">
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="mb-3">
                                    <label for="title" class="form-label">News Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="News Headline" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">News Category</label>
                                    <br>
                                    <select name="category" id="category" class="p-2 flex-fill btn opt" required>
                                        <?php foreach ($categories as $kategori) : ?>
                                            <option class="text-start" value="<?php echo ($kategori['category_id']) ?>">
                                                <?php echo ($kategori['category_id']) ?> - <?php echo ($kategori['category_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Published Date</label>
                                    <input type="date" class="form-control" id="date" name="date" placeholder="Date of the Published News" required>
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">News Author Name</label>
                                    <br>
                                    <select name="author" id="author" class="p-2 flex-fill btn opt" required>
                                        <?php foreach ($authors as $penulis) : ?>
                                            <option class="text-start" value="<?php echo ($penulis['creator_id']) ?>">
                                                <?php echo ($penulis['creator_id']) ?> - <?php echo ($penulis['creator_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">News Status</label>
                                    <br>
                                    <select name="status" id="status" class="p-2 flex-fill btn opt" required>
                                        <?php foreach ($stats as $stat) : ?>
                                            <option class="text-start" value="<?php echo ($stat['status_id']) ?>">
                                                <?php echo ($stat['status_id']) ?> - <?php echo ($stat['status_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Thumbnail</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg" required>
                                </div>
                                <div class="mb-3">
                                    <label for="paragraph" class="form-label">News Content</label>
                                    <textarea class="form-control text-start" id="paragraph" name="paragraph" rows="4" cols="50" required>
                                </textarea>
                                </div>
                                <p><?php if (isset($_SESSION['error'])) {
                                        echo ($_SESSION['error']);
                                    } ?></p>
                                <button type="submit" name="submit" class="btn btn-block btn-primary my-3">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyrights 2022 <a href="#">Exclusive News</a></span>
                    <ul class="nav m-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-secondary">Contact Us</a>
                        </li>
                    </ul>
                </footer>
            </main>
        </div>
    </div>

    <?php
    unset($_SESSION['error']);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>