<?php
session_start();
if (isset($_SESSION['Nom']) && isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['login']) && isset($_SESSION['id']) && isset($_SESSION['image'])) {
    if ($_SESSION['login'] == true) {
        require 'concetion.php';
        $u = new user($_SESSION['Nom'], $_SESSION['email'], $_SESSION['password'], $_SESSION['image'], $_SESSION['id']);
        $c = new conect();
        $c->Connection();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
                move_uploaded_file($_FILES['img']['tmp_name'], "C:\\xampp\htdocs\login_regis\image\\" . $_FILES['img']['name']);
                $u->setImage($_FILES['img']['name']);
                $c->update($u);
                $_SESSION['image'] = $u->getImage();
            }
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Welcome</title>
            <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="Icons/fontawesome-free-6.0.0-web/css/all.min.css">
            <link rel="stylesheet" href="style1.css">
            <link rel="stylesheet" href="image.css">
            <style>
                .profil {
                    width: 100%;
                    height: fit-content;
                }

                .profil img {
                    width: 100%;
                    height: auto;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="login-email" enctype="multipart/form-data">
                    <div class="profil">
                        <img src="image/<?php $i = !empty($_SESSION['image']) ? $_SESSION['image'] : "user.webp";
                                        echo $i; ?>" alt="" srcset="">
                    </div>
                    <p class="login-text" style="font-size: 2rem; font-weight: 800;">Welcome <?php echo  $_SESSION['Nom'] ?></p>
                    <div class="input-group">
                        <input type="file" id="image" name="img" accept="image/*">
                        <label for="image" id="im" style="cursor: pointer;">
                            <i class="fa-solid fa-file-image"></i>&nbsp;
                            Choose a Photo
                        </label>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Full Name" name="fn" value="<?php echo  $_SESSION['Nom'] ?>" required>
                    </div>
                    <div class="input-group">
                        <button name="submit" class="btn">Update</button>
                    </div>
                </form>
                <p class="login-register-text" style="width:fit-content;margin:auto;cursor: pointer;display:flex; justify-content:center;font-weight:800;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <a href="logout.php" class="text-danger">Logout</a>
                </p>
            </div>
        </body>

        </html>

<?php
    }
} else {
    header("Location:index.php");
}
?>