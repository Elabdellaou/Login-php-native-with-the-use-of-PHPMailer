<?php

use function PHPSTORM_META\type;

require 'concetion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $f = new filter_info();
        $f->filter_information($_POST['password'], $_POST['email']);
        $c = new conect();
        $c->Connection();
        $u = new user(null, $_POST['email'], $_POST['password'], null, null);
        $result = $c->select();
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $u->getEmail() && $row['password'] == $u->getPassword()) {
                session_start();
                $_SESSION['password'] = $row['password'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['image'] = $row['Image'];
                $_SESSION['login'] = true;
                $_SESSION['email'] = $row['email'];
                $_SESSION['Nom'] = $row['Nom'];
                header("Location:welcome.php");
                exit();
            }
        }
        header("Location:login.php?err");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Form </title>
    <link rel="stylesheet" href="Icons/fontawesome-free-6.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
</head>

<body onload="focusin()">
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" <?php $s = isset($_GET['err']) ? "display:block !important" : "display:none !important";
                                                                                        echo 'style=' . $s; ?>>
                <strong>Error!</strong> email or password incorrect please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="input-group">
                <input type="email" placeholder="Username@example.com" <?php if (isset($_GET['err']))
                                                                            echo 'class="border-danger"';
                                                                        ?> name="email" value="" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="" maxlength="12" required>
            </div>
            <p class="login-register-text"><a href="Forget_password.php" class="fp">Forget password?</a></p>
            <div class="input-group">
                <button name="submit" class="btn" onclick="setitem()">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php" onclick="setitem()">Register Here</a>.</p>
        </form>
    </div>

    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let email = document.querySelector("[type='email']");
        email.addEventListener('blur', function() {
            window.sessionStorage.setItem('email', email.value);
        })
        if (window.sessionStorage.getItem('email'))
            email.value = window.sessionStorage.getItem('email');

        function focusin() {
            email.focus();
        }
    </script>
</body>

</html>