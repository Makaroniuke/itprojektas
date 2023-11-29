<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

?>  

<head>
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="include/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet"> 
</head>

<body>
	
	
		
		
		<nav class="navbar navbar-expand-lg " style="background-color: rgba(169,227,233,255); font-size: 23px;	">
		  <div class="container-fluid">
			<a class="navbar-brand" href="index.php" style="font-family: 'Raleway'; font-size: 30px;">Foto</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
			  <ul class="navbar-nav ">
				
				  
				  <?php					

					if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
					echo "<a class=\"nav-link\" href=\"konkursas.php\">Pridėti konkursą</a>";
					echo "<a class=\"nav-link\" href=\"kriterijus.php\">Pridėti kriterijų</a>";
				}
				  ?>
				  <?php					

					if ($userlevel == $user_roles[JUDGE_LEVEL] ) {
					//echo "<a class=\"nav-link\" href=\"vertinti.php\">Vertinti nuotraukas</a>";
				}
				  ?>

				  <?php
					//if ($_SESSION['user'] != "guest") echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"useredit.php\">Redaguoti paskyrą</a></li>";
					
					?>
		
				<li class="nav-item">
				  <a class="nav-link"  href="logout.php">Atsijungti</a>
				</li>
				 
			  </ul>
				<ul class='navbar-nav ms-auto'>
				  <li class='nav-item '>
				  	<form class=" justify-content: space-between form-inline my-2 my-lg-0" style="display: flex; align-content: flex-end;">
					<?php
				  echo "$user: $role" ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
					  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
					</svg>
					</form>
				  </li>
				</ul>
			</div>
		  </div>
</nav>
	
	
	

</body>
    
 