<?php
session_start();
require_once "includes/functions.php";

$title = "Popis korisnika";

$con = spajanje();
if($_SESSION['uloga'] !== "1"){
	die('<div class="alert" style="background:yellow;"> 
	<a href="index.php" class="close" data-dismiss="alert" aria-label="close">
	&times;
	</a>
	<strong>Nemate ovlasti za pristup ovoj stranici!</strong>
	
	</div>');
}
else{

$sql = "SELECT users.id, users.ime, users.prezime, users.email, uloge.status, mjesto.naziv 
		FROM users
		INNER JOIN uloge ON uloge.id = users.id_status_fk 
		INNER JOIN mjesto ON mjesto.id = users.id_mjesto_fk ;";

$result = mysqli_query($con, $sql);


	

if(isset($_GET['obrisi']) and isset($_GET['id']) ){
	drop("users");
	header("Location:users.php");
	
}

require_once "includes/header_projekt.php";


if (mysqli_num_rows($result)>0){
	echo '
	<table id = "table" class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Ime</th>
				<th>Prezime</th>
				<th>Mjesto</th>
				<th>E-mail</th>
                <th>Status</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>';

	while($user = mysqli_fetch_assoc($result)){
		echo "
			<tr>
				<td>".$user['id']."</td>
				<td>".$user['ime']."</td>
				<td>".$user['prezime']."</td>
				<td>".$user['naziv']."</td>
				<td>".$user['email']."</td>
				<td>".$user['status']."</td>
				
				<td>
					<a href='user.php?id=".$user["id"]."'><button class = 'btn btn-primary' value = 'uredi' name='uredi' id='uredi''>Uredi</button></a>
				</td>
				<td>
					<a href='users.php?obrisi=true&id=".$user['id']."' onclick='return confirm(\"Jeste li sigurni da zelite obrisati korisnika?\")'>
                        <button class = 'btn btn-primary' value = 'obrisi' name='obrisi' id='obrisi'>Obriši</button>
                    </a>
				</td>
			</tr>";
	}
	echo "</tbody></table>";
}
else {
	
	echo "<p>U bazi nema rezultata za ovaj upit: $sql </p>";
}
}
//--------------------------------
require "includes/footer_projekt.php";
//--------------------------------
							
?>
						
						
						
						
					















