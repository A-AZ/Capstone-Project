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

    <body class="bg-body-secondary">
        <!--header-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark px-3" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="">POS Demo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pages
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (Helper::check_permissions(['dashboard:read'])) : ?>
                                    <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                    <hr class="dropdown-divider">
                                <?php endif; ?>
                                <?php if (Helper::check_permissions(['transactions:create'])) :
                                ?>
                                    <li><a class="dropdown-item" href="/sales">Sales</a></li>
                                <?php endif;
                                if (Helper::check_permissions(['items:create', 'items:read', 'items:update', 'items:delete'])) :
                                ?>
                                    <li><a class="dropdown-item" href="/items">Stock</a></li>
                                <?php endif;
                                if (Helper::check_permissions(['transactions:read', 'transactions:update', 'transactions:delete'])) :
                                ?>
                                    <li><a class="dropdown-item" href="/transactions">Transactions</a></li>
                                <?php endif;
                                if (Helper::check_permissions(['users:create', 'users:read', 'users:update', 'users:delete'])) :
                                ?>
                                    <li><a class="dropdown-item" href="/users">Users</a></li>
                                <?php endif;
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile?id=<?= $_SESSION['user']['id']  ?>"><?= $_SESSION['user']['display_name']?>'s Profile</a>
                        </li>
                    </ul>
                    <a href="./logout" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </nav>
        <!---main--->
        <main>
        <div>
            <div class="container my-5">
            <?php endif; ?>