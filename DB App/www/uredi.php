<?php

class MyDB extends SQLite3 {
	function __construct() {
		$this->open('my_database.db');
	}
}

$db = new MyDB();

$sql = "SELECT * from users";

$result = $db->query($sql);

?>

<style type="text/css">@import url("style.css");</style>

<div class="odjava">

<?php

if($row = $result->fetchArray(SQLITE3_ASSOC)){

echo "<font>Korisnik: ".$row["user"]."</font>";

}

?>

<form action="uredi.php" method="POST">
 	<button type="submit" name="odjava">ODJAVA</button>
</form>

</div>

<br>

<hr>

<div class="navbar">

<ul>

<li><a href="lista.php">Lista klijenata</a></li>

<li style="color:#b30077">|</li>

<li><a href="dodaj.php">Dodaj klijenta</a></li>

</ul>

</div>

<hr>

<br>

<?php

$poruka='<div class="poruka"><b> USPJEŠAN UNOS! </b></div>';
$msg='<div class="msg"><b> UNESITE SVE PODATKE! </b></div>';

$ID = $_GET['id'];

$sql1 = "SELECT * FROM klijenti WHERE id=$ID";
$result1 = $db->query($sql1);
$row1 = $result1->fetchArray(SQLITE3_ASSOC);

echo "<h2>UREÐUJETE PODATKE ZA KLIJENTA: <i>".$row1['ime']." ".$row1['prezime']."</i></h2>";

$ime = (isset($_POST["ime"]) ? $_POST["ime"] : ''); 
$prezime = (isset($_POST["prezime"]) ? $_POST["prezime"] : '');
$br_licne_karte = (isset($_POST["br_licne_karte"]) ? $_POST["br_licne_karte"] : '');

if(isset($_POST["dodaj"])) {

	if($ime != '' && $prezime != '' && $br_licne_karte != ''){

		$sql2 = "UPDATE klijenti SET ime='$ime', prezime='$prezime', br_licne_karte='$br_licne_karte' WHERE id='$ID'";

		$db->query($sql2);

		echo $poruka;

		echo '<meta http-equiv="refresh" content="1; url=lista.php"/>';

	}

	else {
		echo $msg;
	}

}

?>

<div class="dodaj">

<form method="POST">
	<input type="text" name="ime" placeholder="<?php echo $row1['ime'] ?>" size="20" /><br>
	<input type="text" name="prezime" placeholder="<?php echo $row1['prezime'] ?>" size="20" /><br>
	<input type="text" name="br_licne_karte" placeholder="<?php echo $row1['br_licne_karte'] ?>" size="20" /><br>
 	<button type="submit" name="dodaj">UREDI</button>
</form>

</div>