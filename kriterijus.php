

<html>
<head>
	<meta charset='UTF-8'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
          <h2 class="fw-bold mb-5">Koks bus naujas kriterijus?</h2>

            
            <div class="form-outline mb-4">
              <input oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Įveskite kriterijų')" name='kriterijus' type="text" id="form3Example3" class="form-control" required/>
              <label  class="form-label" for="form3Example3">Kriterijus:</label>
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
			$lentele = "Kriterijus";

			$dbc=mysqli_connect($server,$user,$password,$db);
			if(!$dbc){
				die("Negalima prisijungti prie db");	
			}

	if(isset($_POST["ok"])){
		$kriterijus = $_POST['kriterijus'];
		

		

		$sql = "INSERT INTO $lentele (kriterijus) 
		VALUES ('$kriterijus')";
		
		if(!mysqli_query($dbc,$sql)) die('Klaida rasant');
		echo "Sėkmingai pridėta";
		mysqli_close($dbc);
	}
?>
	
	</body>

</html>