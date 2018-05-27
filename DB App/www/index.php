<?php

class MyDB extends SQLite3 {
	function __construct() {
		$this->open('my_database.db');
	}
}

$db = new MyDB();

$sql = "SELECT * from users";

$result = $db->query($sql);

if($row = $result->fetchArray(SQLITE3_ASSOC)){

$user = $row["user"];
$pass = $row["pass"];
$input_user = (isset($_POST["user"]) ? $_POST["user"] : ''); 
$input_pass = (isset($_POST["pass"]) ? $_POST["pass"] : '');
$poruka='<div class="msg"><b> POGREŠAN UNOS! </b></div>';

	if(isset($_POST['prijava'])){

		if($user==$input_user && $pass==$input_pass){
   			header("Location: lista.php");
			exit;
		}

		else {
			echo $poruka;
		}
	}
}

?>

<style type="text/css">@import url("style.css");</style>

<div class="prijava">
<h1>LOGIN</h1>

<form action="index.php" method="POST">
	<input type="username" name="user" placeholder="Username" size="20" /><br>
	<input type="password" name="pass" placeholder="Password" size="20" /><br>
 	<button type="submit" name="prijava">PRIJAVA</button>
</form>

</div>