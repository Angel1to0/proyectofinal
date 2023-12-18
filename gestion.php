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
$nameErr = $emailErr = $ageErr =  $passErr = "";
$name = $email = $age = $pass = "";
	
//Auntenticarse en la BD
$servername = "direccion.ip.del.servidor";
$username = "ususario";
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
 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
  if (empty($_GET["name"])) {    
	  $nameErr = "El nombre es requerido";
  } else {
    $name = test_input($_GET["name"]);    
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
    
  if (empty($_GET["age"])) {
    $age = "";
  } else {
    $age = test_input($_GET["age"]);    
    } 

  if (empty($_GET["pass"])) {
    $pass = "";
  } else {
    $pass = test_input($_GET["pass"]);
  }

#Ingresar los datos en la base de datos
	$sql = "INSERT INTO teachers(name, email, age, pass) VALUES
    	('".$name."', '".$email."', '".$age."','".$pass."')";
 
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