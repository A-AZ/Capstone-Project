<?php

use Core\Helpers\Helper; ?>

<?php if (isset($_SESSION['user'])) : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel=stylesheet href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/css/styles.css">
        <title>POS Demo</title>
    </head>

    <body>

        <nav class="navbar bg-dark navbar-expand-lg navbar-dark bg-primary px-5 d-flex">
            <div class="container-fluid">
                <a class="navbar-brand" href="">POS Demo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <a class="btn btn-success" href="/profile?id=<?=$_SESSION['user']['id']  ?>">Profile</a>
                    <a class="btn btn-danger" href="/logout">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row ">

                <div class="col-1 bg-dark">
                    <ul class="list-group list-group-flush mt-5 bg-dark">
                        <?php if (Helper::check_permissions(['dashboard:read'])) : ?>
                            <li class="list-group-item bg-dark">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                        <?php endif; ?>
                        <?php if (Helper::check_permissions(['transactions:create'])) :
                        ?>
                            <li class="list-group-item bg-dark">
                                <a href="/sales">Sales</a>
                            </li>

                        <?php endif;
                        if (Helper::check_permissions(['items:create', 'items:read', 'items:update', 'items:delete'])) :
                        ?>
                            <li class="list-group-item bg-dark">
                                <a href="/items">Stock</a>
                            </li>
                        <?php endif;
                        if (Helper::check_permissions(['transactions:read', 'transactions:update', 'transactions:delete'])) :
                        ?>
                            <li class="list-group-item bg-dark">
                                <a href="/transactions">Transactions</a>
                            </li>
                        <?php endif;
                        if (Helper::check_permissions(['users:create', 'users:read', 'users:update', 'users:delete'])) :
                        ?>
                            <li class="list-group-item bg-dark">
                                <a href="/users">Users</a>
                            </li>
                        <?php endif;
                        ?>

                    </ul>
                </div>


                <div class="col-11">
                    <div class="container-fluid my-5">
                    <?php endif; ?>