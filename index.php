<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
include("include/functions.php");


?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Fotografijų portalas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>

<?php
           
    if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        
        include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
		<center><h1>"Fotografijų portalas" Laura Capaitė IFK-0</h1></center>
                <div >
                    <br><br>
                    <h1>Naujausi konkursai</h1>
					<br>
					<div class="container ">
						 <ul class="list-group">
						  
						
					
					
					
					<?php
	$server = "localhost";
			$db = "itprojektas";
			$user = "stud";
			$password = "stud";
			$lentele = "Tema";

			$dbc=mysqli_connect($server,$user,$password,$db);
			if(!$dbc){
				die("Negalima prisijungti prie db");	
			}
		
		$sql = "SELECT * FROM $lentele ORDER BY laikas DESC LIMIT 4";
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
				 echo '<h5 class=\"card-title\">' .$row['tema']. '</h5>';
				echo '<p>Konkursas vyksta iki: '.$row['pabaiga']. '</p>';
			echo '<p>Kriterijus: '.$row['kriterijus']. '</p>';
					 ?>
				  <?php
					 if ($row['pabaiga'] > date("Y-m-d")){
					 ?>
				  
					<form method='get' action='dalyvauti.php'>	
						<button value='<?php echo $row['tema']; ?>'  name='dalyvauti' type="submit" class="btn btn-primary btn-block mb-4" >
							Dalyvauti
						</button> 
					</form>
				  <?php
					 }else{
					 ?>
				  <form method='get' action='dalyvauti.php'>	
						<button value='<?php echo $row['tema']; ?>'  name='dalyvauti' type="submit" class="btn btn-primary btn-block mb-4" disabled>
							Dalyvauti
						</button> 
					</form>
				  <?php } ?>
				  <form method='get' action='rodytinuotraukas.php'>			
					<button value='<?php echo $row['tema']; ?>'  name='dalyvauti' type="submit" class="btn btn-primary btn-block mb-4">
              			Peržiūrėti nuotraukas
            		</button>		   
				</form>
				  
				   <?php
				  if ($userlevel == 8){
					  ?>
					  <form method='get' action='vertinti.php'>			
						<button value='<?php echo $row['tema']; ?>'  name='vertinti' type="submit" class="btn btn-primary btn-block mb-4">
							Vertinti
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
			</ul> 
						
			</div>
            </div><br>
		
		
		
		
      <?php
          }                
          else {   			 
              
              if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
              else {if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                   }  
   			  // jei ankstesnis puslapis perdavė $_SESSION['message']
				echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";          
		
                echo "<table class=\"center\"><tr><td>";
          include("include/login.php");                    // prisijungimo forma
                echo "</td></tr></table></div><br>";
           
		  }
		?>
		
		
            </body>
</html>
