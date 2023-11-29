<head>
	
</head>

<?php
session_start();
include("include/functions.php");
$id = $_SESSION['userid'];
$username=$_SESSION['user'];


if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        
        include("include/meniu.php"); 
}//įterpiamas meniu pagal vartotojo rolę
?>

<body>
	
	<?php
	$server = "localhost";
			$db = "itprojektas";
			$user = "stud";
			$password = "stud";
			$lentele = "Fotografija";
			$lentele2 = "Tema";

			$dbc=mysqli_connect($server,$user,$password,$db);
			if(!$dbc){
				die("Negalima prisijungti prie db");	
			}
			if(isset($_GET["vertinti"])){
				$tema = $_GET['vertinti'];

			
		$sql = "SELECT $lentele.id AS ftid, $lentele.pavadinimas, $lentele.nuotrauka AS nuot, $lentele2.kriterijus, Taskai.taskai FROM $lentele 
				JOIN $lentele2 ON $lentele.tema = $lentele2.tema
				left join Taskai on Taskai.fotografija_id = Fotografija.id
				WHERE $lentele2.username = '$username' AND  $lentele.tema = '$tema'";
		
				
		$result = mysqli_query($dbc,$sql);
		?>
		<div class='container' style='display: flex;'>				 
		<?php
		while($row = mysqli_fetch_assoc($result)){
			?>
			
			<div class="card" style="width: 18rem;">
			  <img style='height: 200px;' class="card-img-top" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['nuot']); ?>" alt="Card image cap">
			  <div class="card-body">
				  <?php
				 echo '<h5 class=\"card-title\">' .$row['pavadinimas']. '</h5>';
				echo '<p>Priskirtas kriterijus: ' .$row['kriterijus']. '</p>';
			if($row['taskai'] != NULL){
					 echo '<p>'.$row['kriterijus'].': '.$row['taskai']. '</p>';
			}
					 ?>
				  
				  <?php
				  if($row['taskai'] != NULL){ ?>
				  <form method='get' action='vertinimas.php'>			
					<button disabled  value='<?php echo $row['ftid']; ?>'  name='ivertinti' type="submit" class="btn btn-primary btn-block mb-4">
              			Įvertinti
            		</button>		   
				</form>
				  <?php
				  }else{ ?>
				  <form method='get' action='vertinimas.php'>			
					<button value='<?php echo $row['ftid']; ?>'  name='ivertinti' type="submit" class="btn btn-primary btn-block mb-4">
              			Įvertinti
            		</button>		   
				</form>
				  
		<?php	
		}
			?>
				  
				  
				
				  
			  </div>
			</div>
	

<?php
		}

		mysqli_close($dbc);
			}
?>
			</div>
	
</body>