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
    include 'connect.php';

    $sql = "SELECT news_id, title, date, image, paragraph, category_lists.category_name, 
                    creator_lists.creator_name, news_status.status_name
            FROM news_details
                INNER JOIN category_lists ON news_details.category_id = category_lists.category_id
                INNER JOIN creator_lists ON news_details.creator_id = creator_lists.creator_id
                INNER JOIN news_status ON news_details.status_id = news_status.status_id";

    if (isset($_GET['category'])) {
        $sql = $sql . " WHERE category_name = '" . $_GET['category'] . "'";
    }

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        echo $search;
    }

    $datas = $conn->query($sql);

    $category_sql = "SELECT * FROM category_lists";
    $categories = $conn->query($category_sql);

    $author_sql = "SELECT * FROM creator_lists";
    $authors = $conn->query($author_sql);

    $status_sql = "SELECT * FROM news_status";
    $stats = $conn->query($status_sql);
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-light nav1">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand" href="#">
                    <img class="logo-img" src="assets/logo.png" style="width: 300px;">
                </a>
            </div>
            <form class="d-flex search formsrc" role="search" method="GET">
                <input class="srch1 bg-light" type="text" name="search" placeholder="Search . . .">
                <button class="btn btnsrc" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
            <ul class="ms-3 navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin/index.php">Sign in</a>
                </li>
            </ul>
        </div>
    </nav>
    <ul class="nav bg-light justify-content-center align-items-center nav2" style=" font-size: larger !important; cursor:pointer !important">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">
                <p>HOME</p>
            </a>
        </li>
        <?php
        $category_sql = "SELECT * FROM category_lists";
        $query = $conn->query($category_sql);
        while ($data = mysqli_fetch_array($query)) {
            $kategory = $data['category_name'];
        }
        foreach ($query as $data) : ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php?category=<?php echo $data['category_name'] ?>">
                    <p><?php echo $data['category_name'] ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <main class="container-fluid p-5 d-flex">
        <?php foreach ($datas as $data) : ?>
            <div class="col-8">
                <h3 class="text-center p-2">BREAKING NEWS OF THE WEEK</h3>
                <hr>
                <br>
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $i = 1;
                        foreach ($datas as $data) :
                            if ($data['status_name'] == 'Breaking News') {

                        ?>
                                <?php
                                $date = date_create($data['date']);
                                ?>
                                <div class="carousel-item text-center <?php echo ($i == 1) ? 'active' : '' ?>">
                                    <img src="assets/<?php echo $data['image'] ?>" class="img-fluid img1" alt="...">
                                    <div class="carousel-caption d-none d-md-block mx-auto captions">
                                        <p><?php echo date_format($date, "d M Y") ?></p>
                                        <h3 class="mx-auto"><a class="headnews" href="details.php?id=<?php echo $data['news_id'] ?>"><?php echo $data['title'] ?></a></h3><br>
                                        <a href="details.php?id=<?php echo $data['news_id'] ?>" class="btn btn-light btn-readmore">Read More > </a>
                                    </div>
                                </div>
                        <?php }
                            $i++;
                        endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <br><br>
                <div class="container-fluid p-3">
                    <h3 class="p-2 text-center">HIGHLIGHT NEWS</h3>
                    <hr>
                    <div class="row text-center">
                        <?php
                        $i = 1;
                        foreach ($datas as $data) :
                            if ($data['status_name'] == 'Highlight News') {
                        ?>
                                <div class="col-4">
                                    <div class="card cards1 mt-4" style="height: 450px !important;">
                                        <img src="assets/<?php echo $data['image'] ?>" class="card-img-top mx-auto" style="height: 200px !important;" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title" style="max-height: 70px !important;">
                                                <a href="details.php?id=<?php echo $data['news_id'] ?>" class="headnews">
                                                    <?php echo $data['title'] ?>
                                                </a>
                                            </h5>
                                            <br>
                                            <p class="card-text text-truncate text-center mt-4"><?php echo $data['paragraph'] ?></p>
                                            <a href="details.php?id=<?php echo $data['news_id'] ?>" class="btn btn-light btn-readmore">Read More ></a>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                            $i++;
                        endforeach; ?>
                    </div>
                </div>
                <br> <br>
                <h3 class="p-2 text-center">LATEST NEWS</h3>
                <hr>
                <div class="card cards2 p-2 mx-auto">
                    <?php
                    $i = 1;
                    foreach ($datas as $data) :
                        if ($data['status_name'] == 'Latest News') {
                    ?>
                            <?php
                            $date = date_create($data['date']);
                            ?>
                            <div class="row p-3">
                                <div class="col-5 text-center">
                                    <img src="assets/<?php echo $data['image'] ?>" class="img-fluid w-50" alt="">
                                </div>
                                <div class="col-6">
                                    <h4 class="text-truncate" style="max-width: auto !important;">
                                        <a href="details.php?id=<?php echo $data['news_id'] ?>" class="headnews text-uppercase">
                                            <?php echo $data['title'] ?>
                                        </a>
                                    </h4>
                                    <br>
                                    <p style="color: red !important"><?php echo $data['category_name'] ?> </p>
                                    <p>PUBLISH DATE: <?php echo date_format($date, "d M Y") ?></p>
                                </div>
                            </div>
                    <?php }
                        $i++;
                    endforeach; ?>
                </div>
            </div>

            <div class="col-4 mx-auto">
                <div class="card cards4 p-3 mx-auto">
                    <h3 class="text-center">FOR YOU</h3>
                    <hr>
                    <?php
                    $i = 1;
                    foreach ($datas as $data) :
                        if ($data['status_name'] == 'For You') {

                    ?>
                            <?php
                            $date = date_create($data['date']);
                            ?>
                            <div class="row p-3">
                                <h4><a href="details.php?id=<?php echo $data['news_id'] ?>" class="headnews text-uppercase"><?php echo $data['title'] ?></a></h4>
                                <p style="color: red !important"><?php echo $data['category_name'] ?></p>
                                <p>PUBLISH DATE: <?php echo date_format($date, "d M Y") ?></p>
                            </div>
                            <hr>
                    <?php }
                        $i++;
                    endforeach; ?>
                </div>
                <div class="card cards5 mx-auto">
                    <span class="text-center">Follow Us:</span>
                    <div class="logos text-center">
                        <a href="#"><i class="fa-brands fa-instagram fa-2xl"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter fa-2xl"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook fa-2xl"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok fa-2xl"></i></a>
                    </div>
                </div>
                <div class="card cards6 mx-auto">
                    <span class="text-center">Advertisement</span>
                    <img src="assets/adv1.png" alt="">
                </div>
            </div>
        <?php endforeach; ?>
    </main>

    <div class="card-footer footer bg-light mt-5">
        <div class="row">
            <div class="col-6 ftr-left text-center">
                <img class="logo-img" src="assets/logo.png" style="width: 300px;">
                <p> Copyright © 2022 Executive News. <br> All right reserved.</p>
                <br> <br>
                <h5>Connect With Us</h5>
                <div class="logo-ftr">
                    <a href="#"><i class="fa-brands fa-instagram fa-2xl"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter fa-2xl"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook fa-2xl"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok fa-2xl"></i></a>
                </div>
                <br>
            </div>
            <div class="col-4 ftr-mid text-center mx-auto">
                <div class="row m-3">
                    <h5>Subscribe Now</h5>
                    <p>Keep up to date with our informations</p>
                    <form action="" class="subs justify-content-center">
                        <input type="email" class="input-subs bg-light w-100" placeholder="Email Address" name="email">
                        <br>
                        <button class="btn btn-subs w-100" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>