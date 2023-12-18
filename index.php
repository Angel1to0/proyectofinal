<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// Definir las variables con vadenas vacias
$boletaErr = $nameErr =  $firstlsErr = $secondlsErr = $emailErr = $passErr = $imgErr = $imgCadenaErr = "";
$boleta = $name = $firstls = $secondls = $email = $pass = $img = $imgCadena = "";
	
//Auntenticarse en la BD
$servername = "direccion.ip.del.servidor";
$username = "usuario";
$password = "password";
$dbname = "school";
 
// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}
 

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Si esta madre no sirve ponle un GET <------- RECORDAR BORRARLO ANTES DE PRESENTAR AL PROFE
  
  if (empty($_GET["boleta"])) {
    $boletaErr = "El numero de boleta es requerido";
  } else {
    $boleta = test_input($_GET["boleta"]);
  }
  

  if (empty($_GET["name"])) {    
	  $nameErr = "El nombre es requerido";
  } else {
    $name = test_input($_GET["name"]);    
  }

  if (empty($_GET["firstls"])) {
    $firstlsErr = "El primer apellido es requerido";
  }else {
    $firstls = test_input($_GET["firstls"])
  }
  
  if (empty($_GET["secondls"])) {
    $secondlsErr = "El segundo apellido es requerido";
  }else {
    $firstls = test_input($_GET["secondls"])
  }

  if (empty($_GET["email"])) {
    $emailErr = "El correo es requerido";
  } else {
    $email = test_input($_GET["email"]);
    // Verificar si es un correo correcto
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato de correo no válido";
    }
  }

  if (empty($_GET["pass"])) {
    $pass = "";
  } else {
    $pass = test_input($_GET["pass"]);
  }

  if(isset($_FILES["img"]) && $_FILES["img"]["imgErr"] == 0){
    $img = $_FILES["img"]["tmp_name"];
    $imgCadena = base64_encode(file_get_contents($img));
    echo "Imagen como cadena: " . $imgCadena
  }else {
    echo "Error al cargar la imagen";
  }

#Ingresar los datos en la base de datos
	$sql = "INSERT INTO alumnos(boleta, name, firstls, secondls, email, pass, imgCadena) VALUES
    	( '".$boleta."', '".$name."', '".$firstls."', '".$secondls."', '".$email."','".$pass."', '".$imgCadena."')";
 
	if ($conn->query($sql) === TRUE) {
    	echo "<h2>el estudiante se agregó correctamente</h2>";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

// Cerrar la conexión.
$conn->close();
}


	
	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
echo "";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $age;
echo "<br>";
echo $pass;
?>

</body>
</html>