<head>
	<style>
		input{
			-webkit-rtl-ordering: logical;	
		}
		
		img {
		  display: block;
		  margin-left: auto;
		  margin-right: auto;
		}
	</style>
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
          <h2 class="fw-bold mb-5">Pateikite savo fotografiją:</h2>

            
            <div class="form-outline mb-4">
              <input oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Įveskite fotografijos pavadinimą')"  name='pavadinimas' type="text" id="form3Example3" class="form-control" required/>
              <label  class="form-label" for="form3Example3">Fotografijos pavadinimas:</label>
            </div>

			  <div class="form-outline mb-4">
				  <input hidden oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Pasirinkite fotografiją')" name="paveiksliukas" type="file" accept="image/png, image/jpeg" class="form-control" id="picfile" required/>
				   <label for="picfile" class="form-label btn btn-light" id="picfile_lbl" style="border-width: 1px;">
            			Paspauskite, kad pasirinktumėte nuotrauką
        			</label>
				  <br>
				  <p>(Peržiūrėti savo fotografiją galite žemiau)</p>
			  </div>
            
			  
			  
			  <button  name='ok' type="submit" class="btn btn-primary btn-block mb-4">
              Pateikti
            </button>
			   
			  
  
          
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
			$lentele = "Fotografija";

			$dbc=mysqli_connect($server,$user,$password,$db);
			if(!$dbc){
				die("Negalima prisijungti prie db");	
			}
		
	if(isset($_GET["dalyvauti"])){
		$tema = $_GET['dalyvauti'];
	}

	if(isset($_POST["ok"])){
		$pavadinimas = $_POST['pavadinimas'];
		
		
		$image = $_FILES["paveiksliukas"];
		$info = getimagesize($image["tmp_name"]);
		if(!$info)
		{
			die("File is not an image");
		}
		$name = $image["name"];
		$type = $image["type"];
		$blob = addslashes(file_get_contents($image["tmp_name"]));
		
		
		

		$sql = "INSERT INTO $lentele (pavadinimas,nuotrauka,tema,autorius_id) 
		VALUES ('$pavadinimas', '$blob', '$tema','$id')";
		
		if(!mysqli_query($dbc,$sql)) die('Klaida rasant');
		echo "Sėkmingai pridėta";

		mysqli_close($dbc);
	}
?>
	<script>
		
		const form = document.getElementById("picform");
		const input = document.getElementById("picfile");
		const imageChange = (file) => {
		const blob = new Blob([file]);
		console.log(blob.size)

		// const reader = new FileReader();
		// reader.readAsArrayBuffer(file);

		// reader.onload = function() {
		// const blob = new Blob([file]);
		// console.log(blob.text().then((v) => console.log(v)))
		//};
	}

	input.addEventListener("change", (e) => {
		let existingdisplayElement = document.getElementById("displayElement");
		if (existingdisplayElement) {
			document.getElementById("displayElement").remove();
		}

		if (input && input.files[0]) {
			const file = input.files[0];
			//console.log(file)
			const fileKbSize = (input.files[0].size / 1024).toFixed(2);

			if (file.type === "image/png" || file.type === "image/jpeg") {

				const img = document.createElement("img");
				img.id = "imgToUpload";
				img.src = URL.createObjectURL(input.files[0]);

				img.height = 250;
				img.style.display = "block";
				
				
				
				img.addEventListener("loadstart", (e) => {

				})

				img.addEventListener("load", (e) => {
					e.target.style.display = "block"
					console.log(e.target)
					imgOut = e.target;
					URL.revokeObjectURL(this.src);
					let displayElement = document.createElement("div")
					displayElement.id = "displayElement";
					let displayContent = `${imgOut.outerHTML} <div>  </div>`;
					displayElement.innerHTML = `<span>${displayContent}</span>`
					document.body.appendChild(displayElement)

				})

				imageChange(file);

			} else {
				displayContent = "please select an image file"
			}
		}
	})

	form.addEventListener("submit", (e) => {
		e.preventDefault();
		const formData = new FormData(form);
		const pic = formData.get("fileatt");
	}
	)
		
		
		
	</script>
		
		
		</form>
</body>