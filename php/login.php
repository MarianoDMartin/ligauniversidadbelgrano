<?php  //Start the Session

session_start();
$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');

//Test if connection occurred.
if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}

//3. If the form is submitted or not.
//3.1 If the form is submitted

if (isset($_POST['usuario']) and isset($_POST['contraseña'])){
//3.1.1 Assigning posted values to variables.

	$usuario = $_POST['usuario'];
	$password = $_POST['contraseña'];

//3.1.2 Checking the values are existing in the database or not
	$query = "SELECT * FROM usuarios WHERE usuario='$usuario' and password='$password'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);

//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
	if ($count == 1){
		$_SESSION['usuario'] = $usuario;
		echo "<script language='javascript'>
		alert('Bienvenido!!!');
		window.location.href = '../administracion/inscriptos.php';
		</script>";
	}else{

//3.1.3 If the login credentials doesn't match, he will be shown with an error message.

		echo "<script language='javascript'>
		alert('ERROR: Credenciales invalidas');
		window.location.href = '../usuario.html';
		</script>";
	}
}
/*
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['usuario'])){
	$usuario = $_SESSION['usuario'];
	echo "Hai " . $usuario . "
	";
	echo "This is the Members Area
	";
	echo "<a href='sesion.php'>Logout</a>";

}
//3.2 When the user visits the page first time, simple login form will be displayed.
*/
?>