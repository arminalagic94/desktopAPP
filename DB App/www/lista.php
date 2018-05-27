<?php

class MyDB extends SQLite3 {
	function __construct() {
		$this->open('my_database.db');
	}
}

$db = new MyDB();

$sql = "SELECT * from users";

$result = $db->query($sql);

$sql2 = "SELECT * from klijenti";

$result2 = $db->query($sql2);

if(isset($_POST['odjava'])){

   	header("Location: index.php");
	exit;
}

?>

<style type="text/css">@import url("style.css");</style>
<style type="text/css">@import url("font-awesome-4.7.0\css\font-awesome.min.css");</style>
<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">

<div class="odjava">

<?php

if($row = $result->fetchArray(SQLITE3_ASSOC)){

echo "<font>Korisnik: ".$row["user"]."</font>";

}

?>

<form action="lista.php" method="POST">
 	<button type="submit" name="odjava">ODJAVA</button>
</form>

</div>

<br>

<hr>

<div class="navbar">

<ul>

<li class="active"><a href="lista.php">Lista klijenata</a></li>

<li style="color:#b30077">|</li>

<li><a href="dodaj.php">Dodaj klijenta</a></li>

</ul>

</div>

<hr>

<br>

<?php
	if(isset($_POST['search'])){

		$ime=$_POST['ime'];

		$sql2 = "SELECT * from klijenti where lower(ime)=lower('$ime')";

		$result2 = $db->query($sql2);
	
}
?>

<form action="lista.php" method="POST">
  <input type="text" placeholder="Unesite ime..." name="ime">
  <button type="submit" name="search"><i class="fa fa-search"></i></button>
</form>

<br>

<table>
  <tr>
    <th>ID</th>
    <th>Ime</th> 
    <th>Prezime</th>
    <th>Br Licne Karte</th>
    <th>OBRADA</th>
    <th>STATUS</th>
  </tr>
<?php
while($row2 = $result2->fetchArray(SQLITE3_ASSOC)){ ?>
  <tr>
    <td> <?php echo $row2["id"] ?> </td>
    <td> <?php echo $row2["ime"] ?> </td>
    <td> <?php echo $row2["prezime"] ?> </td> 
    <td> <?php echo $row2["br_licne_karte"] ?> </td>
    <td>
<?php if($row2["verifikacija"]==""){ ?>
	<form action="lista.php" method="POST">
 		<button type="submit" value="<?php echo $row2["id"] ?>" name="uredi" id="uredi"><i class="fa fa-pencil" title="UREDI"></i></button>
 		<button type="submit" value="<?php echo $row2["id"] ?>" name="izbrisi" id="izbrisi"><i class="fa fa-trash" title="IZBRIŠI"></i></button>
 		<button type="submit" value="<?php echo $row2["id"] ?>" name="verifikuj" id="verifikuj"><i class="fa fa-check" title="VERIFIKUJ"></i></button>
 		<button type="submit" value="<?php echo $row2["id"] ?>" name="odbij" id="odbij"><i class="fa fa-times" title="ODBIJ"></i></button>
	</form>
<?php }
	else { ?>

	<font>Z A V R Š E N O</font>

<?php } ?>

</td>

<td>

<?php if($row2["verifikacija"]=="NE") { ?>
 	<i class="fa fa-times" title="ODBIJENO"></i>
<?php }

else if($row2["verifikacija"]=="DA") { ?>
	<a href="word.php?id=<?php echo $row2["id"] ?>" class="word"><i class="fa fa-check-square" title="VERIFIKOVANO"></i></a>
<?php }

else { ?>
	<i class="fa fa-question" title="NEOBRAÐENO"></i>
<?php } ?>
    </td>
  </tr>
<?php } ?>
</table>

<?php 

	$poruka='<div class="poruka"><b> USPJEŠNA OBRADA! </b></div>';

	if(isset($_POST["uredi"])){
		$id=$_POST["uredi"];
		echo '<meta http-equiv="refresh" content="0; url=uredi.php?id='.$id.'"/>';
	}

	if(isset($_POST["izbrisi"])){

		$id=$_POST["izbrisi"];
				
		$sql3 = "DELETE FROM klijenti WHERE id=$id";

		$db->query($sql3);

		echo '<meta http-equiv="refresh" content="1" />';

		echo $poruka;

	}

	if(isset($_POST["verifikuj"])){

		$id=$_POST["verifikuj"];

		$sql4 = "UPDATE klijenti SET verifikacija='DA' WHERE id=$id";

		$db->query($sql4);

		echo '<meta http-equiv="refresh" content="1" />';

		echo $poruka;

	}

	if(isset($_POST["odbij"])){

		$id=$_POST["odbij"];

		$sql5 = "UPDATE klijenti SET verifikacija='NE' WHERE id=$id";

		$db->query($sql5);

		echo '<meta http-equiv="refresh" content="1" />';

		echo $poruka;

	}

?>