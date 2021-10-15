<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $meta_title ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/mystyle.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
    <script src="jquery.js"></script>

</head>

<body>
 <div class="navbar" style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?=base_url()?>/assets/images/banner.png);">
        <nav class="nav row w-100 align-items-center">
            <div class="col-10">
                <a href="home" style="text-decoration: none; font-size:250%;"><b>Pulong</b></a>
            </div>
            <div class="col-1 text-center ">
                <p style="color:white;">name</p>
            </div>
            <div class="col-1 text-center">
                <div>
                    <a href=""><img src="<?=base_url()?>/assets/images/admin.png" alt="" class="nav_img" height="60" width="60"></a>
                </div>
            </div>
        </nav>
    </div>

    <?= $this->renderSection('content') ?>


</body>
</html>
