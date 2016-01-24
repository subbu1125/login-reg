<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login and Reg</title>
	<style>
		form * {
			display: block;
		}
		
		p.error{
			color:red;
		}

	</style>
</head>
<body>
	<h1>Login</h1>
	<?php if($this->session->flashdata('login_errors')){
		echo($this->session->flashdata('login_errors'));
	} ?>
	<form action="users/login" method= "post">
		Email: <input type = "text" name = "email">
		Password: <input type = "password" name = "password">
		<input type = "submit" value = "Submit" >
	</form>
	<h1>Register </h1>
	<?php if($this->session->flashdata('regis_errors')){
		echo($this->session->flashdata('regis_errors'));
	} ?>
	<form action="users/new_user" method= "post">
		First Name: <input type = "text" name = "first_name">
		Last Name: <input type = "text" name = "last_name">
		Email: <input type = "text" name = "email">
		Password: <input type = "password" name = "password">  
		Password Confirmation: <input type = "password" name  = "pw_confirmation">
	<input type = "submit" value = "Register" >
	</form>

</body>
</html>