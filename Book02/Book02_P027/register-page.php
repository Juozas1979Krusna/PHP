<!DOCTYPE html>
<html lan=en>
<head>
	<title>Register page</title>
	<meta charset=utf8>
	<link rel="stylesheet" type="text/css" href="includes.css">
	<style type="text/css">
		p.error{color:red; font-size:105%; font-weight:bold; text-align:center;
	}
/*10*/	</style>
</head>
<body>
	<div id="container">
		<?php include("header.php");?>
		<?php include("nav.php");?>
		<?php include("info-col.php");?>
		<div id="content">
			<p>
				<?php
//20 This script performs an INSERT query taht adds a record to the user table
					if($_SERVER['REQUEST_METHOD']=='POST'){ //B
						$errors = array(); //Initialize an error array
						//Was the first name entered?
						if (empty($_POST['fname'])){
							$errors = 'You did not enter your first name.';
						}else {$fn = trim($_POST['fname']);
						}
						//Was the last name entered?
						if (empty($_POST['lname'])){
/*30*/							$errors[] = 'You did not entered your last name.';
						}else {$ln = trim($_POST['lname']);
						}
						//Was the email address entered?
						if (empty($_POST['email'])) {
							$errors[] = 'You did not entered your last name.';
						}else {$e = trim($_POST['email']);
						}
						//Did the two passwords match?
						if (!empty($_POST['psword1'])) {

							if ($_POST['psword1'] != $_POST['psword2']){
/*40*/								$errors[]= 'Your password were not the same';
							}else {$p = trim($_POST['psword1']);
							}
						}else { $errors[] = 'You did not enter your password.';
						}
//Start of the SUCCESSFULL SECTION. i.e all the the fields were filled out
						if (empty($errors)){ //A
							require('mysqli_connect.php');
							$q = "INSERT INTO users( fname, lname, email, psword, registration_date) VALUES ( '$fn', '$ln', '$e', SHA1('$p'), NOW())";
							$result = @mysqli_query ($dbcon, $q);
/*50*/							if($result) {
								header ("location: register-thanks.php");
								exit();
							}else {
								echo'<h2>System Error</h2>
								<p class="error">You could not be registred due to a system error. We apologise for any inconvenience.</p>';
								echo '<p>'. mysqli_error($dbcon) . '<br><br> Query: ' . $q . '</p>';
							}
							mysqli_close($dbcon);
							include ('footer.php');
/*60*/							exit();
						}else {
							echo '<h2>Error!</h2>
							<p class="error">The following error(s) occurred:<br>';
							foreach ($errors as $msg){
								echo " - $msg<br>\n";
							}
							echo '</p><h3>Please try again.</h3><p><br></p>';
						} 
					} 
				?>
				<h2>Rgister</h2>
				<form action="register-page.php" method="post">

				<p><label class="label" for="fname">First Name:</label><input id="fname" type="text" name="fname" size="30" maxlength="30" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></p>

				<p><label class="label" for="lname">Last Name: </label><input id="lname" type="text" name="lname" size="30" maxlength="40" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></p>

				<p><label class="label" for="email">Email Address:</label><input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>

				<p><label class="psword1" for="psword1">Password:</label><input id="psword1" type="text" name="psword1" size="12" maxlength="12" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >&nbsp; Between 8 and 12 characters.</p>

				<p><label class="psword2" for="psword2">Confirm Password:</label><input id="psword2" type="text" name="psword2" size="12" maxlength="12" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>"></p>

				<p><input id="submit" type="submit" name="submit" value="Register"></p>
				</form>
				<?php include ('footer.php');?></p>
			</p>
		</div>
	</div>
</body>
</html>
