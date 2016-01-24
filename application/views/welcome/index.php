<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
</head>
<body>
	<h2>Welcome, <?= $this->session->userdata('first_name'); ?> </h2>
	<div>
		 <p>First Name:<?= $this->session->userdata('first_name'); ?> </p>
		 <p>Last Name:<?= $this->session->userdata('last_name'); ?> </p>
		 <p>Email: <?= $this->session->userdata('email'); ?> </p>
	</div>
</body>
</html>