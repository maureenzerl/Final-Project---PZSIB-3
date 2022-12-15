<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" />
    <title>Exclusive News</title>
</head>

<body class="bg-dark">
    <?php
    session_start();

    if (isset($_SESSION['status']) != "login") {
        header("location:/finalProject");
    }
    if (isset($_POST['submit'])) {
        session_destroy();
        header("location:/finalProject/admin");
    }

    include '../connect.php';

    $sql = "SELECT * FROM creator_lists";
    $datas = $conn->query($sql);

    while ($data = mysqli_fetch_array($datas)) {
        $name = $data['creator_name'];
    }
    ?>

    <nav class="navbar navbar-light bg-dark p-3 navs">
        <img src="../assets/logo2.png" style="width: 300px;" alt="">
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
                            <button class="dropdown-item" type="submit" name="submit">
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
                        <li class="breadcrumb-item fw-bold"><a class="text-light" href="#">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Overview</li>
                    </ol>
                </nav>
                <div class="row mt-5">
                    <div class="col-3">
                        <div class="card p-3 bg-light card1">
                            <div class="row d-flex inline">
                                <div class="col-4 align-items-center mt-3">
                                    <i class="fa-sharp fa-solid fa-chart-simple fa-3x fa-beat" style="cursor:pointer; color: Mediumslateblue;"></i>
                                </div>
                                <div class=" col-8">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit success">
                                            <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card p-3 bg-light card1">
                            <div class="row d-flex inline">
                                <div class="col-4 align-items-center mt-3">
                                    <i class="fa-sharp fa-solid fa-note-sticky fa-3x fa-beat" style="cursor:pointer; color: Dodgerblue; "></i>
                                </div>
                                <div class=" col-8">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit success">
                                            <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card p-3 bg-light card1">
                            <div class="row d-flex inline">
                                <div class="col-4 align-items-center mt-3">
                                    <i class="fa-sharp fa-solid fa-note-sticky fa-3x fa-beat" style="cursor:pointer; color: gold; "></i>
                                </div>
                                <div class=" col-8">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit danger">
                                            <i data-feather="trending-down" aria-hidden="true"></i>1.64%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card p-3 bg-light card1">
                            <div class="row d-flex inline">
                                <div class="col-4 align-items-center mt-3">
                                    <i class="fa-solid fa-pen fa-3x fa-beat" style="cursor:pointer; color: orangered; "></i>
                                </div>
                                <div class=" col-8">
                                    <p class="stat-cards-info__num">1478 286</p>
                                    <p class="stat-cards-info__title">Total visits</p>
                                    <p class="stat-cards-info__progress">
                                        <span class="stat-cards-info__profit success">
                                            <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                                        </span>
                                        Last month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-lg-0 mt-5">
                        <div class="card card1 bg-light p-0">
                            <h5 class="card-header text-dark">Website Visitors Graphic</h5>
                            <div class="card-body">
                                <div id="view-chart"></div>
                            </div>
                        </div>
                        <div class="card card1 bg-light p-0 mt-3">
                            <h5 class="card-header text-center text-dark">News Report</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">News Title</th>
                                                <th scope="col">News Author</th>
                                                <th scope="col">Latest Update</th>
                                                <th scope="col">Viewers</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Don't serve disordered eating to your teens this holiday season</td>
                                                <td>Tessalonica Musk</td>
                                                <td>08 November 2022</td>
                                                <td>200 Viewers</td>
                                                <td><a href="#" class="btn btn-sm btn-warning">Edit</a></td>
                                            </tr>
                                            <tr>
                                                <td>Don't serve disordered eating to your teens this holiday season</td>
                                                <td>Tessalonica Musk</td>
                                                <td>08 November 2022</td>
                                                <td>200 Viewers</td>
                                                <td><a href="#" class="btn btn-sm btn-warning">Edit</a></td>
                                            </tr>
                                            <tr>
                                                <td>Don't serve disordered eating to your teens this holiday season</td>
                                                <td>Tessalonica Musk</td>
                                                <td>08 November 2022</td>
                                                <td>200 Viewers</td>
                                                <td><a href="#" class="btn btn-sm btn-warning">Edit</a></td>
                                            </tr>
                                            <tr>
                                                <td>Don't serve disordered eating to your teens this holiday season</td>
                                                <td>Tessalonica Musk</td>
                                                <td>08 November 2022</td>
                                                <td>200 Viewers</td>
                                                <td><a href="#" class="btn btn-sm btn-warning">Edit</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="#" class="btn btn-sm btn-primary">Show All</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 mt-5">
                        <div class="card card1 bg-light">
                            <h5 class="card-header text-dark">Current Authors</h5>
                            <div class="card-body text-dark">
                                <ul class="list-group" style="list-style-type: none;">
                                    <li class="list-group-item d-flex inline">
                                        <div class="col-6 text-start">
                                            <?php
                                            foreach ($datas as $key => $data) {
                                                echo '
                                                <p>' . $data['creator_name'] . '</p>';
                                            }
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card card1 bg-light mt-3">
                            <h5 class="card-header text-dark">Categories Graphic</h5>
                            <div class="card-body">
                                <ul class="top-cat-list" style="list-style-type: none;">
                                    <li>
                                        <a href="##">
                                            <div class="top-cat-list__title">
                                                News <span>8.2k</span>
                                            </div>
                                            <div class="top-cat-list__subtitle">
                                                Daily lifestyle articles <span class="purple">+472</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="##">
                                            <div class="top-cat-list__title">
                                                Crime <span>8.2k</span>
                                            </div>
                                            <div class="top-cat-list__subtitle">
                                                Coding tutorials <span class="blue">+472</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="##">
                                            <div class="top-cat-list__title">
                                                Health <span>8.2k</span>
                                            </div>
                                            <div class="top-cat-list__subtitle">
                                                UX design tips <span class="success">+472</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="##">
                                            <div class="top-cat-list__title">
                                                Sport <span>8.2k</span>
                                            </div>
                                            <div class="top-cat-list__subtitle">
                                                Interaction articles <span class="warning">+472</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="##">
                                            <div class="top-cat-list__title">
                                                Finance <span>8.2k</span>
                                            </div>
                                            <div class="top-cat-list__subtitle">
                                                Mobile development articles <span class="warning">+472</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="##">
                                            <div class="top-cat-list__title">
                                                Food <span>8.2k</span>
                                            </div>
                                            <div class="top-cat-list__subtitle">
                                                Wildlife animal articles <span class="warning">+472</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="##">
                                            <div class="top-cat-list__title">
                                                Technology <span>8.2k</span>
                                            </div>
                                            <div class="top-cat-list__subtitle">
                                                Daily technology articles <span class="danger">+472</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="bower_components/chartist/dist/chartist.min.js"> </script>
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script>
        new Chartist.Line('#view-chart', {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            series: [
                [85, 80, 76, 90, 120, 127, 118, 129, 131, 109, 119, 124]
            ]
        }, {
            fullWidth: true,
            chartPadding: {
                right: 40
            }
        });
    </script>
</body>

</html>