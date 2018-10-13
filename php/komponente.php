<?php
session_start();
require_once "includes/functions.php";
	// error_reporting(0);
$title = "Popis komponenti";
$con = spajanje();
require_once "includes/header_projekt.php";

if($_SESSION['login'] === true){
if($_SESSION['uloga'] == "1" or $_SESSION['uloga']=="2"){
	$sql = "SELECT
			proizvodi.id,
			proizvodi.ddr_type,
			proizvodi.socket,
			proizvodi.chipset,
			proizvodi.velicina,
			proizvodi.watt,
			proizvodi.cijena,
			proizvodi.naziv_proizvoda,
			proizvodi.url,
			proizvodac.naziv_proizvodaca,
			tipovi_komponenti.naziv
		FROM
			proizvodi
		INNER JOIN proizvodac ON proizvodac.id = proizvodi.id_proizvodac_fk	
		INNER JOIN tipovi_komponenti ON tipovi_komponenti.id = proizvodi.komponenta_tip_fk;";

$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result)>0){
	echo '<div class="container">';
	while($proizvod = mysqli_fetch_assoc($result)){
			echo '
			<div id = "'.$proizvod['id'].'" class="stack-cards col-lg-3"><div class="card">
			<img class="card-img-top small-thumbnail" src="'.$proizvod["url"].'" alt="proizvod">
			<div class="card-body">
			  <h6 class="card-title">'.$proizvod["naziv_proizvoda"].'</h6>
			  <p class="card-text">'.$proizvod["cijena"].'</p>
			  <a href="komponenta.php?id='.$proizvod["id"].'" class="btn btn-primary">Uredi</a>
			</div>
		  </div>
		  </div>';
		
		
	}
	echo "</div>";
}
else {
	echo "<p>Trenutno nema dostupnih proizvoda na sklkadistu!</p>";
}
//--------------------------------

//--------------------------------

}

else{
$sql = "SELECT
			proizvodi.id,
			proizvodi.ddr_type,
			proizvodi.socket,
			proizvodi.chipset,
			proizvodi.velicina,
			proizvodi.watt,
			proizvodi.cijena,
			proizvodi.naziv_proizvoda,
			proizvodi.url,
			proizvodac.naziv_proizvodaca,
			tipovi_komponenti.naziv
		FROM
			proizvodi
		INNER JOIN proizvodac ON proizvodac.id = proizvodi.id_proizvodac_fk	
		INNER JOIN tipovi_komponenti ON tipovi_komponenti.id = proizvodi.komponenta_tip_fk;";

$result = mysqli_query($con, $sql);

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location.reload();</script>';
			}
		}
	}
	else{
				echo '<script>window.location.assign("komponente.php?id='.$_GET['id'].'");</script>';
	}
}


	$query = "SELECT * FROM proizvodi ORDER BY id ASC";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
				?>
		<div clasS = "container">
			<div class="col-lg-4 stack-cards">
				<form method="post" action="komponente.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style = "display:inline;" class="card">
						<img class="card-img-top small-thumbnail" src="<?php echo $row["url"]; ?>" alt="proizvod"><br />
							<div class="card-body">
							
							<h6 class="card-title"><?php echo $row["naziv_proizvoda"]; ?></h6>

							<p class="card-text"><?php echo $row["cijena"]; ?></p>

							<input type="text" name="quantity" value="1" class="col-md-2 form-control" />

							<input type="hidden" name="hidden_name" value="<?php echo $row["naziv_proizvoda"]; ?>" />

							<input type="hidden" name="hidden_price" value="<?php echo $row["cijena"]; ?>" />

							<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Dodaj u košaricu" />
							
							</div>
					</div>
				</form>
			</div>
		</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Detalji narudžbe</h3>
			<div class="col-lg-2 table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Naziv</th>
						<th width="10%">Količina</th>
						<th width="20%">Cijena</th>
						<th width="15%">Ukupno</th>
						<th width="5%"></th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="komponente.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Ukloni</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Ukupno</td>
						<td align="right"><?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br />

	
<?php
if(isset($_GET['obrisi']) and isset($_GET['id']) ){
	drop("proizvodi");
	header("Location:komponente.php");
	
}
$_SESSION['kosarica'] = $_GET['id'];


if (mysqli_num_rows($result)>0){
	echo '<div style = "position:absolute; left:21.5%;padding-bottom:120px;" class="container">';
	while($proizvod = mysqli_fetch_assoc($result)){
			echo '
			<div class="stack-cards col-lg-4">
			<div style = "display:inline-block;" class="card">
			<img class="card-img-top small-thumbnail" src="'.$proizvod["url"].'" alt="proizvod">
			<div class="card-body">
			  <h6 class="card-title">'.$proizvod["naziv_proizvoda"].'</h6>
			  <p class="card-text">'.$proizvod["cijena"].'</p>
			  <a href="komponenta.php?id='.$proizvod["id"].'" class="btn btn-primary">Pogledaj</a>
			</div>
		  </div>
		  </div>';
		
		
	}
	echo "</div>";
}
else {
	echo "<p>Trenutno nema dostupnih proizvoda na lageru!</p>";
}
}
}
//--------------------------------
require_once "includes/footer_projekt.php";
mysqli_close($con);
//--------------------------------
							
?>
						
			
						
						
					














