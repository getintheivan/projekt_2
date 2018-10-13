<?php
        
    session_start();
    $title = "Dodaj komponentu";
    require_once "includes/functions.php";
    $con = spajanje();
    if($_SESSION['uloga'] !== "1"and ($_SESSION['uloga']!=="2")){
        die('<div class="alert" style="background:yellow;"> 
        <a href="index.php" class="close" data-dismiss="alert" aria-label="close">
        &times;
        </a>
      
        
        </div>');
        }
    else{
    if(!empty($_POST['posalji'])){
        
        $ddr_type = ocisti_tekst($_POST['ddr_type']);
        $socket = ocisti_tekst($_POST['socket']);
        $chipset = ocisti_tekst($_POST['chipset']);
        $id_proizvodac_fk= ocisti_tekst($_POST['id_proizvodac_fk']);
        $komponenta_tip_fk = ocisti_tekst($_POST['komponenta_tip_fk']);
        $velicina = ocisti_tekst($_POST['velicina']);
        $watt = ocisti_tekst($_POST['watt']); 
        $cijena = ocisti_tekst($_POST['cijena']); 
        $naziv_proizvoda = ocisti_tekst($_POST['naziv_proizvoda']); 
		$url = ocisti_tekst($_POST['url']);

        $sql = "INSERT INTO
               `proizvodi` 
                (`ddr_type`,`socket`,`chipset`,`id_proizvodac_fk`,`komponenta_tip_fk`,velicina,`watt`,cijena,naziv_proizvoda,url)
                VALUES (
                    '$ddr_type',
                    '$socket',
                    '$chipset',
                    '$id_proizvodac_fk',
					'$komponenta_tip_fk', 
                    '$velicina',              
                    '$watt',
					'$cijena',
					'$naziv_proizvoda',
					'$url'
                 );";
        $res = mysqli_query($con,$sql);

        if($res){
            $id = mysqli_insert_id($con);
            header("Location:komponenta.php?id=$id");
			$_POST = array();
			exit();
        }
        else{
            echo "Komponenta nije dodana - " .mysqli_error($con);
        }
	
    }
    }
    
    require_once ("includes/header_projekt.php"); 
?>

<div class = "container">
    <form class = "form-horizontal" action="" method = "post">

        <div style = "margin-top:10px;" class="form-group">
		    <label for ="ddr_type" class="col-sm-2 control-label">DDR tip</label>
		        <div class = "col-sm-7">
			        <input type="text" id="ddr_type" name="ddr_type" class ="form-control" value "" >
		        </div>
	    </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="socket">Unesite socket:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='socket' id='socket'  value = "" > 
                </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label" for="chipset">Unesite chipset:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='chipset' id='chipset'  value = "" >
                </div>
        </div>

         <!-- select -->
        <div class="form-group">
          <label class="col-sm-2 control-label" for="id_proizvodac_fk">Odaberite proizvodača:</label>
            <div class = "col-sm-7">
                <select class ="form-control" type="text" name='id_proizvodac_fk' id='id_proizvodac_fk' required>
                
                <option value="NULL" selected disabled>--</option>

                <?php 
                
                $sql = "SELECT * FROM proizvodac";
                $res_maker = mysqli_query ($con, $sql);

                if(mysqli_num_rows($res_maker)>0){
                    while($maker = mysqli_fetch_assoc($res_maker)){
                            echo '<option value="'.$maker['id'].'">';
                            echo ucfirst($maker['naziv_proizvodaca']);
                            echo '</option>'; 
                    }
                }

                ?>

                </select>
            </div>
        </div>
		
		<!-- select -->
        <div class="form-group">
          <label class="col-sm-2 control-label" for="komponenta_tip_fk">Odaberite tip komponente:</label>
            <div class = "col-sm-7">
                <select class ="form-control" type="text" name='komponenta_tip_fk' id='komponenta_tip_fk' required>
                
                <option value="NULL" selected disabled>--</option>

                <?php 
                
                $sql = "SELECT * FROM tipovi_komponenti";
                $res_type = mysqli_query ($con, $sql);

                if(mysqli_num_rows($res_type)>0){
                    while($type = mysqli_fetch_assoc($res_type)){
                            echo '<option value="'.$type['id'].'">';
                            echo ucfirst($type['naziv']);
                            echo '</option>'; 
                    }
                }

                ?>

                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="velicina">Unesite veličinu:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='velicina' id='velicina' value = "" >
                </div>
        </div>

        <div class="form-group"> 
            <label class="col-sm-2 control-label" for="watt">Upišite snagu:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='watt' id='watt' value = "">
                </div>
        </div>



        <div class="form-group"> 
            <label class="col-sm-2 control-label" for="cijena">Upišite cijenu:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='cijena' id='cijena' value = "" step = "0.01" required>
                </div>
        </div>
		
		 <div class="form-group"> 
            <label class="col-sm-2 control-label" for="naziv_proizvoda">Upišite naziv proizvoda:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='naziv_proizvoda' id='naziv_proizvoda' value = "" required>
                </div>
        </div>
		
		<div class="form-group"> 
            <label class="col-sm-2 control-label" for="url">Unesite link slike:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='url' id='url' value = "" required>
                </div>
        </div>


        <div class="form-group">
          <div class="col-sm-2 col-sm-offset-5">
            <input class ="form-control btn btn-primary" id="posalji" value = "Dodaj proizvod" name="posalji" type="submit">
          </div>
        </div>
    </form>   
</div>

<?php require_once("includes/footer_projekt.php");?>