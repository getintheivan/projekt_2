<?php
        
    session_start();
    $title = "Upis novog korisnika";
    require_once "includes/functions.php";
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
    if(!empty($_POST['posalji'])){
        
        $ime = ocisti_tekst($_POST['ime']);
        $prezime = ocisti_tekst($_POST['prezime']);
        $username = ocisti_tekst($_POST['username']);
        $password = ocisti_tekst(md5($_POST['password']));
        $email = ocisti_tekst($_POST['email']);
        $id_mjesto_fk = ocisti_tekst($_POST['id_mjesto_fk']);
        $id_status_fk = ocisti_tekst($_POST['id_status_fk']); 

        $sql = "INSERT INTO
               `users` 
                (`ime`,`prezime`,`username`,`password`,`email`,`id_mjesto_fk`,`id_status_fk`)
                VALUES (
                    '$ime',
                    '$prezime',
                    '$username',
                    '$password',
					'$email',
					'$id_mjesto_fk',
                    '$id_status_fk'
                 );";
				 
        $res = mysqli_query($con,$sql);

        if($res){
            $id = mysqli_insert_id($con);
			$_POST = array();
            header("Location:user.php?id=$id");
            exit();
        }
        else{
            echo "korisnik nije upisan " .mysqli_error($con);
        }
    }
    }
    
    require_once ("includes/header_projekt.php"); 
?>

<div class = "container">
    <form class = "form-horizontal" action="" method = "post">

        <div style = "margin-top:10px;" class="form-group">
		    <label for ="ime" class="col-sm-2 control-label">Ime</label>
		        <div class = "col-sm-7">
			        <input type="text" id="ime" name="ime" class ="form-control" value "" required>
		        </div>
	    </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="prezime">Unesite prezime:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='prezime' id='prezime'  value = "" required> 
                </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Unesite korisničko ime:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="text" name='username' id='username'  value = "" required>
                </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="password">Unesite lozinku :</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="password" name='password' id='password'  value = "" required>
                </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">Unesite email:</label>
                <div class = "col-sm-7">
                    <input class ="form-control" type="email" name='email' id='email' value = "" required>
                </div>
        </div>

        <!-- select -->
        <div class="form-group">
          <label class="col-sm-2 control-label" for="id_mjesto_fk">Odaberite mjesto:</label>
            <div class = "col-sm-7">
                <select class ="form-control" type="text" name='id_mjesto_fk' id='id_mjesto_fk' required>
                
                <option value="NULL" selected disabled>--</option>

                <?php 
                
                $sql = "SELECT * FROM mjesto";
                $res_mj = mysqli_query ($con, $sql);

                if(mysqli_num_rows($res_mj)>0){
                    while($mj = mysqli_fetch_assoc($res_mj)){
                            echo '<option value="'.$mj['id'].'">';
                            echo ucfirst($mj['naziv']);
                            echo '</option>'; 
                    }
                }

                ?>

                </select>
            </div>
        </div>



        <!-- select -->
        <div class="form-group">
          <label class="col-sm-2 control-label" for="id_status_fk">Odaberite ulogu:</label>
            <div class = "col-sm-7">
                <select class ="form-control" type="text" name='id_status_fk' id='id_status_fk' required>
                
                <option value="NULL" selected disabled>--</option>

                <?php 
                
                $sql = "SELECT * FROM uloge";
                $res_roles = mysqli_query ($con, $sql);

                if(mysqli_num_rows($res_roles)>0){
                    while($roles = mysqli_fetch_assoc($res_roles)){
                            echo '<option value="'.$roles['id'].'">';
                            echo ucfirst($roles['status']);
                            echo '</option>'; 
                    }
                }

                ?>

                </select>
            </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 col-sm-offset-5">
            <input class ="form-control btn btn-primary" id="posalji" value = "Dodaj korisnika" name="posalji" type="submit">
          </div>
        </div>
    </form>   
</div>

<?php require_once("includes/footer_projekt.php");?>