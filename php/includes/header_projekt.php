
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> <?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../bootstrap/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/agency.css" rel="stylesheet" type = "text/css">
	<!--DataTables CSS-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

	
	

	<style>
	
.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 10rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: white;
  background-clip: padding-box;
  border: 0px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
}
form{
	margin-top:10px;
}
.small-thumbnail{
	  width: 240px;
    height: 180px;
	  
}
.card{
	border:0 solid transparent;
}
.footer-container {
    background-color:grey;
    height:60px;
    width:100%;
    position:fixed;
    bottom:0;
    z-index:0;
    clear: both;
}

.footer {
	background-color: inherit;
	text-align: center;
	background-color: transparent;
    height:60px;
    position:absolute;
    bottom:0;
    width:100%;
	margin-bottom:50px;
}


	</style>
	  </head>

    <body id="page-top" name = "top">
  
	 
<?php 
error_reporting(0);
if(isset($_SESSION['login']) and $_SESSION['login'] == true){
	
	if(isset($_POST['naruci'])){
		$id_orders = array();
		for($i=0;$i<=count($_SESSION['shopping_cart']);$i++){
		   array_push($id_orders,$_SESSION['shopping_cart'][$i]['item_id']);
		}
		$id_orders = rtrim(implode(",",$id_orders),",");
		$user = $_SESSION['userid'];
		$sql_order = "INSERT INTO narudzbe
					  (`id_naruceni_proizvodi_fk`, `id_user_fk`) 
					  VALUES
					  ('$id_orders',$user);";
		$res_order = mysqli_query($con, $sql_order);
		
		
		if($res_order){
			$SESSION['shopping_cart'] = "";
			$_POST = array();
			header("refresh:2;url=index.php");
			echo    '<div class="alert" style="background:#0090bc; color:white;"> 
					<a href="#" class="close" data-dismiss="alert" aria-label="close">
					&times;
					</a>
					<strong>Narudžba poslana!</strong>
					</div>';
			exit();
		}
		
		else{
		  header("refresh:2;url=index.php");
		  echo '<div class="alert" style="background:yellow;"> 
				<a href="index.php" class="close" data-dismiss="alert" aria-label="close">
				&times;
				</a>
				<strong>Narudžba nije poslana! Greška: '.mysqli_error($con).'</strong>
				</div>';
		  exit();
		}
	}
	
    if($_SESSION['uloga'] == "3"){
      
  echo '   
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" class="navbar-header"><a href="index.php" class="navbar-brand">THREAD</a>
      <div class="container"> 
        
		<ul class = "navbar-nav nav navbar-left text-uppercase ml-auto">
			<li class = "nav-item">
				<a class = "nav-link js-scroll-trigger" href = "index.php #top" for = "top">na vrh</a>
			</li>
		</ul>
		
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
		
		
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
			
			<li class="dropdown nav-item">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-2x fa-ambulance"></i></a>
				<ul class  ="dropdown-menu">';
				
					echo '
					<li class="nav-item"><div style="clear:both"></div>
			<br />
			<h3>Detalji narudžbe</h3>
			<div class="table-responsive-sm">
			<form action = "" method = "post">
				<table class="table table-bordered">
					<tr>
						<th>Naziv proizvoda</th>
						<th>Cijena</th>
						<th>Ukupno</th>
						<th></th>
					</tr>';
					
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					echo '
					<tr>
						<td>'; echo $values["item_name"]; echo'</td>
						<td>'; echo $values["item_price"];echo'kn</td>
						<td id = "delete"><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$values["item_id"].'"><span class="text-danger">Remove</span></a></td>
					</tr>';
					
							$total = $total + $values["item_price"];
						}
					echo'
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">';echo number_format($total, 2); echo'</td>
						<td></td>
					</tr>';
					
					}
					
					echo '	
				</table>
			
	</div>
	</li><li class="nav-item"><button type = "submit" class = "btn btn-success" name = "naruci" id = "naruci">Naruči</button></li></form>';
				
				echo '	</li></ul>
			
			
			
            <li class="dropdown nav-item">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">'.$_SESSION["username"].'</a>
				<ul class  ="dropdown-menu"  >
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="cpu.php">Cpu</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="maticna_ploca.php">Matična ploča</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="napajanje.php">Napajanje</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="graficka_kartica.php">Grafička kartica</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="hdd.php">Tvrdi disk</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="ssd.php">SSD</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="memorija.php">Memorija</a></li>
				</ul>
			</li>			
			
			 <li class="nav-item">
              <a class="nav-link js-scroll-trigger" for ="servisi" href="#servisi">Servisi</a>
            </li>
			
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about" for = "about">O nama</a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact" for = "contact">Kontakt</a>
            </li>
			
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="odjava.php" for = "odjava">Odjava</a>
            </li>
			
		</ul>	
			
			
			
			
			
			
		  
		 
	
        
    </nav>
	<!-- Header -->
   <header class="masthead"> 
	
      <div class="container">
        <div class="intro-text">
	 </div>
      </div>
	
    </header>';
	}
	
	
	else if($_SESSION['uloga'] == "2"){
      
  echo '
  
        
       
        
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" class="navbar-header"><a href="index.php" class="navbar-brand">THREAD</a>
      <div class="container"> 
        
		<ul class = "navbar-nav nav navbar-left text-uppercase ml-auto">
			<li class = "nav-item">
				<a class = "nav-link js-scroll-trigger" href = "#top" for = "top">na vrh</a>
			</li>
		</ul>
		
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
			
			
			
          
			
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" for = "akcije" href="dodaj_komponente.php">dodaj komponente</a>
            </li>
			
			 <li class="nav-item">
              <a class="nav-link js-scroll-trigger" for ="servisi" href="komponente.php">Popis komponenti</a>
            </li>
			
           <li class="dropdown nav-item">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">'.$_SESSION["username"].'</a>
				<ul class  ="dropdown-menu"  >
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="odjava.php">Odjava</a></li>
				</ul>
			</li>

          </ul>
		 
	
        </div>
      </div>
    </nav>
	 <!-- Header -->
   <header class="masthead"> 
	
      <div class="container">
        <div class="intro-text">
	
	</div>
      </div>
	
    </header>';
	}
	
  
  
  
  
  else if($_SESSION['uloga'] == "1"){
      
  echo '
   
        
       
        
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" class="navbar-header"><a href="index.php" class="navbar-brand">THREAD</a>
      <div class="container"> 
        
		<ul class = "navbar-nav nav navbar-left text-uppercase ml-auto">
			<li class = "nav-item">
				<a class = "nav-link js-scroll-trigger" href = "index.php#top" for = "top">Na vrh</a>
			</li>
		</ul>
		
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
			
			
			
            <li class="dropdown nav-item">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Izbornik</a>
				<ul class ="dropdown-menu" >
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="user_add.php">dodaj korisnika</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="users.php">korisnici</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="dodaj_komponente.php">dodaj komponente</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="komponente.php">Popis komponenti</a></li>
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="mjesto_add.php">Dodaj mjesto u bazu</a></li>
				</ul>
			</li>
			

			<li class="dropdown nav-item">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">'.$_SESSION["username"].'</a>
				<ul class  ="dropdown-menu"  >
					<li><a class = "nav-link" style = "color:black; font-weight:bold;" href="odjava.php">Odjava</a></li>
				</ul>
			</li>

          </ul>
		  
		 
	
        </div>
      </div>
    </nav>
	<!-- Header -->
   <header class="masthead"> 
	
      <div class="container">
        <div class="intro-text">
	
	</div>
      </div>
	
    </header>';
	}
  }
	else{

		echo '
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" class="navbar-header"><a href="index.php" class="navbar-brand">THREAD</a>
      <div class="container"> 
        
		<ul class = "navbar-nav nav navbar-left text-uppercase ml-auto">
			<li class = "nav-item">
				<a class = "nav-link js-scroll-trigger" href = "index.php#top" for = "top">na vrh</a>
			</li>
		</ul>
		
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
			
			
			
            <li class="dropdown nav-item" >
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" >komponente</a>
				<ul class ="dropdown-menu"  >
				
					<li><a class = "nav-link " id = "cpu" style = "color:black; font-weight:bold;"  href="cpu.php">Cpu</a></li>
					
					<li><a class = "nav-link " id = "maticna_ploca" style = "color:black; font-weight:bold;"  href="maticna_ploca.php">Matična ploča</a></li>
					
					<li><a class = "nav-link " id = "napajanje" style = "color:black; font-weight:bold;"  href="napajanje.php">Napajanje</a></li>
					
					<li><a class = "nav-link " id = "graficka_kartica" style = "color:black; font-weight:bold;"  href="graficka_kartica.php">Grafička kartica</a></li>
					
					<li><a class = "nav-link " id = "hdd" style = "color:black; font-weight:bold;"  href="hdd.php">Tvrdi disk</a></li>
					
					<li><a class = "nav-link " id = "ssd" style = "color:black; font-weight:bold;"  href="ssd.php">SSD</a></li>
					
					<li><a class = "nav-link " id = "memorija" style = "color:black; font-weight:bold;"  href="memorija.php">Memorija</a></li>
					
				</ul>
			</li>
			
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" for = "akcije" href="index.php#akcije">Akcije</a>
            </li>
			
			 <li class="nav-item">
              <a class="nav-link js-scroll-trigger" for ="servisi" href="#services">servis</a>
            </li>
			
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" for = "about" href="index.php#about" for = "about">O nama</a>
            </li>
			
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="prijava.php">Prijava</a>
            </li>
			
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="registracija.php">registriraj se</a>
            </li>

          </ul>
		  
		 
	
        </div>
      </div>
    </nav>
	
	 <!-- Header -->
   <header class="masthead"> 
	
      <div class="container">
        <div class="intro-text">
	</div>
      </div>
	
    </header>';
	}
	
  
  
	?>
	