<?php

class MyDB extends SQLite3 {
	function __construct() {
		$this->open('my_database.db');
	}
}

$db = new MyDB();

$sql = "SELECT * from users";

$result = $db->query($sql);

if(isset($_POST['odjava'])){

   	header("Location: index.php");
	exit;
}

?>

<style type="text/css">@import url("style.css");</style>

<div class="odjava">

<?php

if($row = $result->fetchArray(SQLITE3_ASSOC)){

echo "<font>Korisnik: ".$row["user"]."</font>";

}

?>

<form action="dodaj.php" method="POST">
 	<button type="submit" name="odjava">ODJAVA</button>
</form>

</div>

<br>

<hr>

<div class="navbar">

<ul>

<li><a href="lista.php">Lista klijenata</a></li>

<li style="color:#b30077">|</li>

<li class="active"><a href="dodaj.php">Dodaj klijenta</a></li>

</ul>

</div>

<hr>

<br>

<?php

$ime = (isset($_POST["ime"]) ? $_POST["ime"] : ''); 
$prezime = (isset($_POST["prezime"]) ? $_POST["prezime"] : '');
$br_licne_karte = (isset($_POST["br_licne_karte"]) ? $_POST["br_licne_karte"] : '');
$poruka='<div class="poruka"><b> USPJEŠAN UNOS! </b></div>';
$msg='<div class="msg"><b> UNESITE SVE PODATKE! </b></div>';
$msg2='<div class="msg"><b> KORISNIK VEC POSTOJI! </b></div>';

if(isset($_POST['dodaj'])) {

	if($ime != '' && $prezime != '' && $br_licne_karte != ''){

		$sql5 = "SELECT * FROM klijenti WHERE br_licne_karte='$br_licne_karte'";
		$result5=$db->query($sql5);
		$row5 = $result5->fetchArray(SQLITE3_ASSOC);

		if($br_licne_karte != $row5["br_licne_karte"]){

			$sql1 = "INSERT INTO klijenti (ime, prezime, br_licne_karte, verifikacija) VALUES ('$ime', '$prezime', '$br_licne_karte', '')";

			$db->exec($sql1);

			echo '<meta http-equiv="refresh" content="1" />';

			echo $poruka;
			
		}

		else {
			echo $msg2;
		}
	}

	else {
		echo $msg;
	}

}

?>

<div class="dodaj">

<h1>Novi klijent:</h1>

<form action="dodaj.php" method="POST">
	<input type="text" name="ime" placeholder="Unesite ime" size="20" /><br>
	<input type="text" name="prezime" placeholder="Unesite prezime" size="20" /><br>
	<input type="text" name="br_licne_karte" placeholder="Unesite br licne karte" size="20" /><br>
 	<button type="submit" name="dodaj">DODAJ</button>
</form>

</div>
