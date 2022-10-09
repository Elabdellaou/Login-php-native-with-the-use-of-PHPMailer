<?php
session_start();
require 'concetion.php';
require_once 'mail.php';
if ($_SERVER['REQUEST_METHOD'] = "POST") {
    if (isset($_POST['search'])) {
        $c = new conect();
        $c->Connection();
        $result = $c->select();
        $_SESSION['mail'] = $_POST['email'];
        while ($row = $result->fetch_assoc()) {
            if ($_POST['email'] == $row['email']) {
                header('Location:Forget_password.php?valider');
                exit();
            }
        }
        header('Location:Forget_password.php?err');
    }
    if (isset($_POST['send'])) {
        $mail->setFrom('', '');//(email,username)
        //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress($_SESSION['mail']);               //Name is optional
        $mail->Subject = 'Reset password';
        $mail->Body    = '<b>to reset password</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        $mail->send();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget_password</title>
    <link rel="stylesheet" href="../Quiz_Coding/Icons/fontawesome-free-6.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
    <style>
        .send {
            position: relative;
            z-index: 1;
            display: none;
        }

        .send i {
            position: absolute;
            z-index: 2;
            left: 60%;
            top: 50%;
            color: white;
            font-size: 1.4rem;
            transition: .3s;
        }

        .send .btn:hover+i {
            transform: translateY(-5px);
        }
    </style>
</head>

<body onload="focusin()">
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-email">
            <p class="login-text" style="font-size: 1.5rem; font-weight: 600;text-align:left !important;">Enter your email address</p>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" <?php $s = isset($_GET['err']) ? "display:block !important" : "display:none !important";
                                                                                        echo 'style=' . $s; ?>>
                <strong>Error!</strong> email incorect.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="input-group">
                <input type="email" placeholder="Username@example.com" <?php if (isset($_GET['err']))
                                                                            echo 'class="border-danger"';

                                                                        if (isset($_GET['valider']))
                                                                            echo "disabled";
                                                                        ?> name="email" value="<?php if (isset($_SESSION['mail']) && isset($_GET['err']) || isset($_GET['valider']))
                                                                                                    echo $_SESSION['mail'];
                                                                                                ?>" required>
            </div>
            <div class="input-group" <?php $d = isset($_GET['valider']) ? "none" : "block";
                                        echo 'style="display:' . $d . ';"'; ?>>
                <button type="submit" name="search" class="btn">Search</button>
            </div>
            <div class="input-group send" <?php $s = isset($_GET['valider']) ? "block" : "none";
                                            echo 'style="display:' . $s . ';"'; ?>>
                <button type="submit" name="send" class="btn">Send</button>
                <i class="fa-solid fa-paper-plane"></i>
            </div>
            <div class="input-group">
                <a href="login.php" class="btn cancel bg-white" style="font-size: 1.2rem;">Cancel</a>
            </div>
        </form>
    </div>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function focusin() {
            document.querySelector('[type="email"]').focus();
        }
    </script>
</body>

</html>