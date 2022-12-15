<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/details.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Exclusive News</title>
</head>

<body class="bg-dark">
    <?php
    include 'connect.php';

    $id = $_GET['id'];
    $sql = "SELECT news_id, title, date, image, paragraph, category_lists.category_name, 
                    creator_lists.creator_name, news_status.status_name
            FROM news_details
                INNER JOIN category_lists ON news_details.category_id = category_lists.category_id
                INNER JOIN creator_lists ON news_details.creator_id = creator_lists.creator_id
                INNER JOIN news_status ON news_details.status_id = news_status.status_id
            WHERE news_id=$id";

    $datas = $conn->query($sql);

    while ($data = mysqli_fetch_array($datas)) {
        $title = $data['title'];
        $category = $data['category_name'];
        $date = date_create($data['date']);
        $image = $data['image'];
        $paragraph = $data['paragraph'];
        $author = $data['creator_name'];
        $status = $data['status_name'];
    }

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
                <a class="navbar-brand" href="index.php">
                    <img class="logo-img" src="assets/logo.png" style="width: 300px;">
                </a>
            </div>
            <form class="d-flex search formsrc" role="search">
                <input class="srch1 bg-light" type="text" placeholder="Search . . .">
                <button class="btn btnsrc" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
            &nbsp;
            &nbsp;
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin/index.php">Sign in</a>
                </li>
                &nbsp;
                &nbsp;
            </ul>
        </div>
    </nav>
    <ul class="nav bg-light justify-content-center align-items-center nav2">
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

    <main class="container-fluid mx-auto">
        <h1><?php echo $title ?></h1>
        <div class="row">
            <p><strong><?php echo $category ?></strong></p>
            <p>Publish Date: <?php echo date_format($date, "d M Y") ?></p>
        </div>
        <div class="row">
            <img src="assets/<?php echo $image ?>" class="img-fluid w-100 img1" alt="">
        </div>
        <br>
        <hr>
        <div class="row d-flex">
            <p class="d-flex lh-lg fs-5 paragraph1" style="white-space:pre-line;">
                <?php echo nl2br($paragraph) ?>
        </div>
        <br>
        <div class="row">
            <p>By <?php echo $author ?></p>
        </div>
        <br>
        <hr>
        <div class="container-fluid p-3">
            <h3 class="p-2 text-center">News You Might Read</h3>
            <br>
            <div class="row text-center">
                <?php
                $id = $_GET['id'];
                $sql2 = "SELECT news_id, title, date, image, paragraph, category_lists.category_name, 
                                creator_lists.creator_name, news_status.status_name
                        FROM news_details
                                INNER JOIN category_lists ON news_details.category_id = category_lists.category_id
                                INNER JOIN creator_lists ON news_details.creator_id = creator_lists.creator_id
                                INNER JOIN news_status ON news_details.status_id = news_status.status_id";

                $datas = $conn->query($sql2);

                while ($data = mysqli_fetch_array($datas)) {
                    $title = $data['title'];
                    $category = $data['category_name'];
                    $date = date_create($data['date']);
                    $image = $data['image'];
                    $paragraph = $data['paragraph'];
                    $author = $data['creator_name'];
                    $status = $data['status_name'];
                }
                $i = 1;
                foreach ($datas as $data) :
                    if ($data['status_name'] == 'Might Read News') {
                ?>
                        <div class="col-4">
                            <div class="card cards1">
                                <img src="assets/<?php echo $data['image'] ?>" class="card-img-top mx-auto" style="height: 180px !important;" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title" style="height: 70px !important;">
                                        <a href="details.php?id=<?php echo $data['news_id'] ?>" class="headnews">
                                            <?php echo $data['title'] ?>
                                        </a>
                                    </h6>
                                    <a href="details.php?id=<?php echo $data['news_id'] ?>" class="btn btn-light btn-readmore">Read More</a>
                                </div>
                            </div>
                        </div>
                <?php }
                    $i++;
                endforeach; ?>
            </div>
        </div>
    </main>

    <div class="footer bg-light">
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