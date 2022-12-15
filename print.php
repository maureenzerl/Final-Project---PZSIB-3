<?php
ob_start();
include "connect.php";

$sql = "SELECT news_id, title, date, image, paragraph, category_lists.category_name, 
                creator_lists.creator_name, news_status.status_name
        FROM news_details
                INNER JOIN category_lists ON news_details.category_id = category_lists.category_id
                INNER JOIN creator_lists ON news_details.creator_id = creator_lists.creator_id
                INNER JOIN news_status ON news_details.status_id = news_status.status_id";

$datas = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Exclusive News</title>

    <style>
        body {
            font-size: small !important;
            text-align: center;
            font-size: small;
        }

        .header1 {
            margin: 2%;
            text-align: center;
            color: blue;
            font-weight: 300;
            font-size: x-large;
        }

        .card {
            text-align: center;
            margin: 1%;
        }

        .table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
        }

        .paragraph {
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="header1">
        <a class="navbar-brand">
            <strong>Exclusive News</strong>
        </a>
    </div>
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>News Title</th>
                    <th>Category</th>
                    <th>Publish Date</th>
                    <th>News Thumbnail</th>
                    <th>News Content</th>
                    <th>News Author</th>
                    <th>News Status</th>
                </tr>
            </thead>
            <?php foreach ($datas as $data) : ?>
                <?php
                $date = date_create($data['date']);
                ?>
                <tr>
                    <td><?php echo $data['title']; ?></td>
                    <td><?php echo $data['category_name'] ?></td>
                    <td><?php echo date_format($date, "d M Y"); ?></td>
                    <td><?php echo $data['image'] ?></td>
                    <td class="paragraph"><?php echo $data['paragraph']; ?></td>
                    <td><?php echo $data['creator_name'] ?></td>
                    <td><?php echo $data['status_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>

<?php
//load library mpdf
require './mpdf/vendor/autoload.php';
//inisialisasi objek mpdf
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_top' => 25,
    'margin_bottom' => 25,
    'margin_left' => 20,
    'margin_right' => 20,
    'padding' => 10
]);

//masukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

//hapus isi output buffering
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));

//buat output file
$content = $mpdf->Output("print.pdf", "D");
?>