<?php 
// login.php - tai prisijungimo forma, index.php puslapio dalis 
// formos reikšmes tikrins proclogin.php. Esant klaidų pakartotinai rodant formą rodomos klaidos
// formos laukų reikšmės ir klaidų pranešimai grįžta per sesijos kintamuosius
// taip pat iš čia išeina priminti slaptažodžio.
// perėjimas į registraciją rodomas jei nustatyta $uregister kad galima pačiam registruotis

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
$_SESSION['prev'] = "login";
include("include/nustatymai.php");
?>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body>


<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0">Fotografijų portalas</span>
        </div>

        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form action="proclogin.php" method="POST" > 

            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Prisijungimas</h3>

            <div class="form-outline mb-4">
              <input name="user" type="text" id="form2Example18" class="form-control form-control-lg" value="<?php echo $_SESSION['name_login'];  ?>"/>
              <label class="form-label" for="form2Example18">Prisijungimo vardas</label>
            <?php echo $_SESSION['name_error']; 
			?>
			  </div>

            <div class="form-outline mb-4">
              <input name="pass" type="password" id="form2Example28" class="form-control form-control-lg" value="<?php echo $_SESSION['pass_error'];  ?>"/>
              <label class="form-label" for="form2Example28">Slaptažodis</label>
           <?php echo $_SESSION['pass_error']; 
			?>
			  </div>

            <div class="pt-1 mb-4">
              <button name="login" class="btn btn-info btn-lg btn-block" type="submit">Prisijungti</button>
            </div>

            <p class="small mb-5 pb-lg-2"><button type="submit" name="problem" class="btn">Pamiršote slaptažodį?</button></p>
            <p>Neturite prisijungimo?  <?php
			if ($uregister != "admin") { echo "<a class=\"link-info\" href=\"register.php\">Registracija</a>";}
			?></p>
			

			  <a class="link-info" href="guest.php">Arba apsilankykite kaip svečias</a>
          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="include/login.jpeg"
          alt="Login image" class="w-100 vh-100" style="height: 100%; object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
	
</body>


