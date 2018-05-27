<?php
ob_start();

class MyDB extends SQLite3 {
	function __construct() {
		$this->open('my_database.db');
	}
}

$db = new MyDB();

?>

<html>

<style type="text/css">@import url("style.css");</style>

<div class="izgledWordDoc">

<h1>R J E � E N J E</h1>

<p><font>Sadr�aj odnosno tekst rje�enja koji �e biti prikazan na word dokumentu koji �e se automatski kreirati i koji �e sadr�avati tekst sa podacima klijenta. Ime klijenta je:
<i><b>

<?php
	$id = $_GET["id"];
	$sql = "select * from klijenti where id=$id";
	$result = $db->query($sql);

	if($row = $result->fetchArray(SQLITE3_ASSOC)){
		echo "<font>".$row['ime']." ".$row['prezime']."</font><br>";
	}

	
?>

</b></i>
</font>
</p>

</div>

<font>U Biha�u
<?php
	$datum = date("d.m.y");
	echo $datum;
?>
</font>

<font>
Potpis odgovorne osobe
______________________
</font>

</html>

<?php
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; Filename=".$row['ime']." ".$row['prezime']." - Rjesenje.doc");
	header("Pragma: no-cache");
	header("Expires: 0");
?>