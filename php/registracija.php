<?php
        
    session_start();
    $title = "Registriraj se";
    require_once "includes/functions.php";
    $con = spajanje();
    

		if(!empty($_POST['registracija'])){
         
		$ime = ocisti_tekst($_POST['ime']);
		$prezime = ocisti_tekst($_POST['prezime']);
		$username = ocisti_tekst($_POST['username']);
		$password = ocisti_tekst(md5($_POST['password']));
		$email = ocisti_tekst($_POST['email']);
		$id_mjesto_fk = ocisti_tekst($_POST['id_mjesto_fk']);
		$pbr = ocisti_tekst($_POST['pbr']);
		
		
        $sql_user = "INSERT INTO
               `users` 
                (`ime`,`prezime`,`id_mjesto_fk`,`email`,`username`,`password`,`id_status_fk`)
                VALUES (
                    '$ime',
                    '$prezime',
					'$id_mjesto_fk',
					'$email', 
                    '$username',
                    '$password',
					3
                 );";
		
        $res_user = mysqli_query($con,$sql_user);
		
        if($res_user){
            header("Location:index.php");
			$_POST = array();
			exit();
        }
        else{
			die("korisnik nije upisan " .mysqli_error($con));
            echo "korisnik nije upisan " .mysqli_error($con);
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
		
		<div class="form-group">
          <label class="col-sm-2 control-label" for="id_mjesto_fk">Odaberite mjesto:</label>
            <div class = "col-sm-7">
                <select class ="form-control" name='id_mjesto_fk' id='id_mjesto_fk' value = "" required>
                <option value="NULL" selected disabled>--</option>

                <?php 
                
                $sql = "SELECT * FROM mjesto";
                $res_mjesto = mysqli_query ($con, $sql);

                if(mysqli_num_rows($res_mjesto)>0){
                    while($mjesto = mysqli_fetch_assoc($res_mjesto)){
                            echo '<option value="'.$mjesto['id'].'">';
                            echo $mjesto['naziv'];
                            echo '</option>'; 
                    }
                }

                ?>

                </select>
            </div>
        </div>

        




        <div class="form-group">
          <div class="col-sm-2 col-sm-offset-5">
            <input class ="form-control btn btn-primary" id="registracija" value = "registracija" name="registracija" type="submit">
          </div>
        </div>
    </form>   
</div>

<?php require_once("includes/footer_projekt.php");?>