<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
	<section style="background-color: #dbeeee;">
  <div class="container my-5 py-5 text-dark">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-6">
        <div class="card">
          <div class="card-body p-4">
            <div class="d-flex flex-start w-100">
              
              <div class="w-100">
                <h5>Parašykite komentarą:</h5>
                <form method='post'>
                <div class="form-outline">
                  <textarea required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Reikalingas komentaras')" name='komentaras' class="form-control" id="textAreaExample" rows="4"></textarea>
                  <label class="form-label" for="textAreaExample">Ką manai apie šią nuotrauką?</label>
                </div>
                <div class="d-flex justify-content-between mt-3">
					
                  	
					<a href='index.php' class="btn btn-danger">Atgal</a>
					
					<button   name='ok' type="submit" class="btn btn-success ">
              			Komentuoti
            		</button>
					
                  
                </div>
					</form>
              </div>
			 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
	
	<?php
	$server = "localhost";
			$db = "itprojektas";
			$user = "stud";
			$password = "stud";
			$lentele = "Komentaras";

			$dbc=mysqli_connect($server,$user,$password,$db);
			if(!$dbc){
				die("Negalima prisijungti prie db");	
			}

	if(isset($_POST["ok"])){
		$komentaras = $_POST['komentaras'];
		$fotoid = $_GET['komentuoti'];
		
		$sql = "INSERT INTO $lentele (komentaras, fotografija_id, autorius_id) 
		VALUES ('$komentaras', '$fotoid', '$id')";
		
		if(!mysqli_query($dbc,$sql)) die('Klaida rasant');
		echo "Sėkmingai pridėta";
		mysqli_close($dbc);
	}
?>
	
	
	
</body>