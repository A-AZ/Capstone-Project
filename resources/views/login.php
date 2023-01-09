<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/css/styles.css">
    <title>login</title>
</head>

<body class="loginBody">
    <div id="login-container">
        <form id="login" method="POST" action="/authenticate">
        <strong><h2> Login Page</h2></strong>
                <br><input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
            <div id="remeber_me_container">
                <input type="checkbox" id="remember_me" name="remember_me">
                <label for="remember_me">Remember Me</label>
            </div>
            <button id="login_button" type="submit">Login</button>
        </form>
    </div>
</body>

</html>