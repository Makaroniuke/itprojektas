

<html translate="no">
<head>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>
      
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" >
    </script>
      
    <script src=
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" >
    </script>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker-bs5.min.css">
</head>

	
	<?php
session_start();
include("include/functions.php");
if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        
        include("include/meniu.php"); 
}//įterpiamas meniu pagal vartotojo rolę
?>
<body>
	<form method='post' enctype="multipart/form-data">
		<section class="text-center">
		  <!-- Background image -->
		  <div class="p-5 bg-image" style="
				background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
				height: 300px;
				"></div>
		  <!-- Background image -->

		  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
				margin-top: -100px;
				background: hsla(0, 0%, 100%, 0.8);
				backdrop-filter: blur(30px);
				">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Kokia bus naujo konkurso tema?</h2>

            
            <div class="form-outline mb-4">
              <input oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Reikalinga tema')" name='tema' type="text" id="form3Example3" class="form-control" required/>
              <label  class="form-label" for="form3Example3">Konkurso tema:</label>
            </div>

			  <div class="form-outline mb-4">
				  <input hidden accept="image/png, image/jpeg" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Pateikite viršelio nuotrauką')"name="paveiksliukas" type="file" class="form-control" id="customFile" required/>
				  <label class="form-label btn btn-light" for="customFile">Paspauskite, kad pridėtumėte viršelio nuotrauką</label>
			  </div>
			
			<div class='form-outline mb-4'>
				<input type='text' class="form-control" id='datepicker' name="end" required min="1997-01-01" max="2030-12-31">
				<label for="datepicker">Iki kada vyks konkursas:</label>		 
			</div>
            
			<div class="form-outline mb-4">
				<div class='container' style="display: flex;">
					<?php
					$server = "localhost";
					$db = "itprojektas";
					$user = "stud";
					$password = "stud";
					$lentele = "Tema";
					$db=mysqli_connect($server, $user, $password, $db);
					$sql = "SELECT kriterijus FROM Kriterijus";
					 $result = mysqli_query($db, $sql);
					 if (!$result || (mysqli_num_rows($result) < 1))  	{echo "Klaida skaitant lentelę users"; exit;}

					echo "<select required name=\"kriterijus\" class=\"form-select\">";
					echo "<option selected disabled>Pasirinkite Kriterijų</option>";
					while ($row = mysqli_fetch_assoc($result)) 
					 {	$kriterijus= $row['kriterijus'];
						  echo "<option value=".$kriterijus.">".$kriterijus."</option>";
						 }
					echo "</select>";
					?>

					
					
					<?php
					$server = "localhost";
					$db = "itprojektas";
					$user = "stud";
					$password = "stud";
					$lentele = "Tema";
					$db=mysqli_connect($server, $user, $password, $db);
					$sql = "SELECT username FROM users WHERE userlevel = 8";
					 $result = mysqli_query($db, $sql);
					 if (!$result || (mysqli_num_rows($result) < 1))  	{echo "Klaida skaitant lentelę users"; exit;}

					echo "<select required name=\"vertintojas\" class=\"form-select\">";
					echo "<option selected disabled>Pasirinkite Vertintoją</option>";
					while ($row = mysqli_fetch_assoc($result)) 
					 {	$vertintojas= $row['username'];
						  echo "<option value=".$vertintojas.">".$vertintojas."</option>";
						 }
					echo "</select>";
					?>
					
				</div>
				
				<label class="form-label" for="kriterijus">Pasirinkite kriterijus bei vertintojus:</label>
			  </div>
			
			

			  
			  
			  <button  name='ok' type="submit" class="btn btn-primary btn-block mb-4">
              Pateikti
            </button>
			   
			  
  
          
        </div>
      </div>
    </div>
  </div>
</section>
		</form>
		<?php
	$server = "localhost";
			$db = "itprojektas";
			$user = "stud";
			$password = "stud";
			$lentele = "Tema";
			$lentele2 = "Taškai";

			$dbc=mysqli_connect($server,$user,$password,$db);
			if(!$dbc){
				die("Negalima prisijungti prie db");	
			}

	if(isset($_POST["ok"])){
		$tema = $_POST['tema'];
		$kriterijus = $_POST['kriterijus'];
		$vertintojas = $_POST['vertintojas'];
		$data = $_POST['end'];
		echo $data;
		
		

		
		
		$image = $_FILES["paveiksliukas"];
		$info = getimagesize($image["tmp_name"]);
		if(!$info)
		{
			die("File is not an image");
		}
		$name = $image["name"];
		$type = $image["type"];
		
		$blob = addslashes(file_get_contents($image["tmp_name"]));
		
		//$imgData = $_FILES['img'];
		//$blob = addslashes(file_get_contents($imgData["tmp_name"]));

		$sql = "INSERT INTO $lentele (tema,pabaiga,nuotrauka,kriterijus, username) 
		VALUES ('$tema','$data', '$blob', '$kriterijus', '$vertintojas')";
		
		
		
		
		
		echo "Sėkmingai pridėta";
		if(!mysqli_query($dbc,$sql)) die('Klaida rasant');
		

		mysqli_close($dbc);
	}
?>
	
	</body>
	<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/js/datepicker-full.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/js/locales/lt.js"></script>
	<script> 
		const elem = document.getElementById('datepicker');
		const datepicker = new Datepicker(elem, {
  			format: "yyyy-mm-dd",
			language: "lt"
		}); 
	</script>
</html>