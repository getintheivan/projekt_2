<?php
session_start();
require_once "includes/functions.php";
	error_reporting(0);

$title = "Napajanje";

$con = spajanje();

	$sql="SELECT
    proizvodi.id,
    proizvodi.watt,
    proizvodi.cijena,
    proizvodi.naziv_proizvoda,
    proizvodi.url,
    tipovi_komponenti.naziv,
    proizvodac.naziv_proizvodaca
FROM
    proizvodi
INNER JOIN tipovi_komponenti ON proizvodi.komponenta_tip_fk = tipovi_komponenti.id
INNER JOIN proizvodac ON proizvodac.id = proizvodi.id_proizvodac_fk
WHERE
    proizvodi.komponenta_tip_fk = '3';";

$result = mysqli_query($con, $sql);

require_once "includes/header_projekt.php";

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
			echo '<script>alert("Item Already Added");return false;</script>';
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
				echo '<script>window.location.assign("'.$_SERVER['PHP_SELF'].'?id='.$_GET['id'].'");</script>';
	}
}


	$query = "SELECT * FROM proizvodi WHERE komponenta_tip_fk = 3 ORDER BY id ASC";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
				echo '
		<div class = "container">
			<div class="col-lg-4 stack-cards">
				<form method="post" action="'.$_SERVER['PHP_SELF'].'?action=add&id='.$row["id"].'">
					<div style = "display:inline;" class="card">
						<img class="card-img-top small-thumbnail" src="'.$row["url"].'" alt="proizvod"><br />
							<div class="card-body">
							
							<h6 class="card-title">'.$row["naziv_proizvoda"].'</h6>

							<p class="card-text">'.$row["cijena"].'</p>

							<input type="text" name="quantity" value="1" class="col-md-2 form-control" />

							<input type="hidden" name="hidden_name" value="'.$row["naziv_proizvoda"].'" />

							<input type="hidden" name="hidden_price" value="'.$row["cijena"].'" />

							<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Dodaj u košaricu" />
							
							</div>
					</div>
				</form>
			</div>
		</div>';
					}
				}
	
else{
	echo "<p>Trenutno nema dostupnih proizvoda u košarici!</p>";
}


//--------------------------------
require_once "includes/footer_projekt.php";
//--------------------------------

?>
						
						
						
						
					















