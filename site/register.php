<?php
	require("config.php");
	
	if(isset($_POST["submitbtn"])) {
		$formelems = array("fname", "lname", "username", "password", "email");

		$treated = array();
		foreach($formelems as $elem) {
			$treated[$elem] = htmlentities(preg_replace('/\s\s+/', ' ', ($_POST[$elem])));
		}

		$db = new DBel();
		$check = $db->q("INSERT INTO users (`id`, `username`, `firstname`, `lastname`, `email`, `password`) VALUES (NULL, :u, :f, :l, :e, :p)", 5, array(":u"=>$treated["username"], ":f"=>$treated['fname'], ":l"=>$treated["lname"], ":e" => $treated["email"], ":p" => $treated["password"]), 1);
		if($check[1] == 1) {
			echo 'Registration Successful! Go to <a href="login.php">login page</a>.';
		}
	}

	require("incls/header.php");

	$f = new formMaker();

	echo $f->create("register", array("POST", "register.php"));
?><br><div style="text-align:center">Please use generic passwords. Hashing has not yet been deployed, so they will be readable.</div>
<?php require_once("incls/footer.php"); ?>