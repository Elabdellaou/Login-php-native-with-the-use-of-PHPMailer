<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="Icons/fontawesome-free-6.0.0-web/css/all.min.css">
	<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">

	<title>Register Form</title>
</head>

<body onload="focuser()">
	<div class="container">
		<form action="newAccount.php" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<?php
			$er = "";
			if (isset($_GET['err']))
				$er = "Email already exists.";
			?>
			<div class="alert alert-danger alert-dismissible fade show" <?php $s = isset($_GET['err']) ? "display:block !important" : "display:none !important";
																		echo 'style=' . $s;
																		?>role="alert">
				<strong>Error!</strong>
				<p style="display: inline;"><?php echo $er; ?></p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php if (isset($_SESSION['name']) && isset($_GET['err']))
																						echo $_SESSION['name'];
																					?>" required>
			</div>
			<div class="input-group">
				<input type="email" <?php if (isset($_GET['err']))
										echo 'class="border-danger"';
									?> placeholder="Username@example.com" name="email" value="<?php if (isset($_SESSION['email']) && isset($_GET['err']))
																									echo $_SESSION['email'];
																								?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password Maximum 12" name="password" maxlength="12" value="" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" maxlength="12" value="" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn" onclick="setitem()">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
	<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
	<script>
		function setitem() {
			let e = document.querySelector("[type='email']").value;
			window.sessionStorage.setItem('email', e);
		}

		//submit valider
		let diver = document.querySelector(".alert.alert-danger");
		let diver_p = document.querySelector(".alert.alert-danger p");
		let p = document.querySelectorAll("[type='password']");
		let inp = document.querySelectorAll("input");


		document.forms[0].onsubmit = function(e) {
			let ps = false;
			let cps = false;
			let eror = "";
			if (p[0].value.length >= 6) {
				if (p[0].hasAttribute("class"))
					p[0].removeAttribute("class");
				ps = true;
			} else {
				let a = 0;
				inp.forEach(ele => {
					if (ele.hasAttribute("class"))
						a = 1;
				});
				if (a == 0)
					p[0].classList.add("border-danger");
				eror = "Please enter a password of 6 characters or more.";
			}
			if (p[0].value == p[1].value) {
				if (p[1].hasAttribute("class"))
					p[1].removeAttribute("class");
				cps = true;
			} else {
				if (eror.length == "") {
					let b = 0;
					inp.forEach(ele => {
						if (ele.hasAttribute("class"))
							b = 1;
					});
					if (b == 0)
						p[1].classList.add("border-danger");
					eror = "Password confirm.";
				}
			}
			if (ps == false || cps == false) {
				e.preventDefault();
				diver.style.cssText = "display:block !important;";
				diver_p.textContent = eror;
			}
			focuser();
		}

		function focuser() {
			a = 0;
			inp.forEach(ele => {
				if (ele.hasAttribute("class")) {
					ele.focus();
					a = 1;
				}
			});
			if (a == 0) {
				inp[0].focus();
			}
		}
	</script>
</body>

</html>