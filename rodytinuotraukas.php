<head>
	
</head>

<?php
session_start();
include("include/functions.php");
$id = $_SESSION['userid'];
 
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

			$dbc=mysqli_connect($server,$user,$password,$db);
			if(!$dbc){
				die("Negalima prisijungti prie db");	
			}
			if(isset($_GET["dalyvauti"])){
				$tema = $_GET['dalyvauti'];
			}
		
		$sql = "SELECT Fotografija.id, Fotografija.nuotrauka, Fotografija.pavadinimas, Tema.kriterijus, Tema.pabaiga, Taskai.taskai FROM Fotografija LEFT JOIN
				Taskai ON Fotografija.id = Taskai.fotografija_id
				inner join Tema on Fotografija.tema = Tema.tema
				Where Fotografija.tema = '$tema'";
		$result = mysqli_query($dbc,$sql);
		?>
		<div class='container' style='display: flex;'>				 
		<?php
		while($row = mysqli_fetch_assoc($result)){
			?>
			
			<div class="card" style="width: 18rem;">
			  <img style='height: 200px;' class="card-img-top" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['nuotrauka']); ?>" alt="Card image cap">
			  <div class="card-body">
				  <?php
				 echo '<h5 class=\"card-title\">' .$row['pavadinimas']. '</h5>';
			if($row['taskai'] != NULL){
					 echo '<p>'.$row['kriterijus'].': '.$row['taskai']. '</p>';
			}
			
					 ?>
				  
				  <?php
				  if ($_SESSION['user'] != "guest"){
					  ?>
				  <form method='get' action='writecomment.php'>			
					<button value='<?php echo $row['id']; ?>'  name='komentuoti' type="submit" class="btn btn-primary btn-block mb-4">
              			Parašyti komentarą
            		</button>		   
				</form>
				 <form method='get' action='readcomment.php'>			
					<button value='<?php echo $row['id']; ?>'  name='skaityti' type="submit" class="btn btn-primary btn-block mb-4">
              			Skaityti komentarus
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
	
?>
			</div>
	
</body>