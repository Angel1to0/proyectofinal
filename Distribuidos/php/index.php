<!DOCTYPE HTML>  
<html>
<head>
  <style>
    body{
        background-image: url(../assets/img/fondo.avif);
    }
    .neon{
      position: relative;
      display: inline-block;
      padding: 15px 30px;
      color: black;
      letter-spacing: 4px;
      font-size: 15px;
      text-align: none;
      overflow: hidden;
      transition: 0.2s;
    }

    .neon:hover{
      background: blue;
      box-shadow: 0 0 10px blue, 0 0 40px blue, 0 0 80px blue;
      transition-delay: 0.3s;
    } 

    .neon span{
      position: absolute;
      display: block;
    }

    .error {color: #FF0000;}
  </style>
</head>
<body>  

<?php
// Definir las variables con cadenas vacías para mensajes de error y datos del formulario
$boletaErr = $nameErr = $firstlsErr = $secondlsErr = $emailErr = $passErr = $imgErr = $imgCadenaErr = "";
$boleta = $name = $firstls = $secondls = $email = $pass = $img = $imgCadena = "";
	
// Autenticarse en la BD (Base de Datos)
$servername = "proyectofinal-bd.mysql.database.azure.com";
$username = "Angel";
$password = "Password123456";
$dbname = "sarpa";
 
// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Validar y recoger datos del formulario

  // Validar boleta
  if (empty($_POST["boleta"])) {
    $boletaErr = "El número de boleta es requerido";
  } else {
    $boleta = test_input($_POST["boleta"]);
  }

  // Validar nombre
  if (empty($_POST["nombre"])) {    
    $nameErr = "El nombre es requerido";
  } else {
    $name = test_input($_POST["nombre"]);    
  }

  // Validar primer apellido
  if (empty($_POST["paterno"])) {
    $firstlsErr = "El primer apellido es requerido";
  } else {
    $firstls = test_input($_POST["paterno"]);
  }
  
  // Validar segundo apellido
  if (empty($_POST["materno"])) {
    $secondlsErr = "El segundo apellido es requerido";
  } else {
    $secondls = test_input($_POST["materno"]);
  }

  // Validar correo electrónico
  if (empty($_POST["email"])) {
    $emailErr = "El correo es requerido";
  } else {
    $email = test_input($_POST["email"]);
    // Verificar si es un correo válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato de correo no válido";
    }
  }

  // Recoger y validar contraseña
  if (empty($_POST["pass"])) {
    $pass = "";
  } else {
    $pass = test_input($_POST["pass"]);
    $pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);
  }

  // Procesar la imagen si se ha adjuntado
  if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
    $img = $_FILES["img"]["tmp_name"];
    
    // Verificar el tipo de imagen (puedes agregar más tipos según tus necesidades)
    $allowed_types = array('jpeg', 'jpg', 'png', 'gif');
    $img_info = pathinfo($_FILES["img"]["name"]);
    $img_extension = strtolower($img_info['extension']);
    
    if (in_array($img_extension, $allowed_types)) {
      $imgCadena = base64_encode(file_get_contents($img));
      echo "Imagen como cadena: " . $imgCadena;
    } else {
      $imgErr = "Formato de imagen no válido. Solo se permiten JPEG, JPG, PNG, GIF.";
    }
  } else {
    $imgErr = "Error al cargar la imagen";
  }

  // Insertar datos en la base de datos
  $sql = "INSERT INTO alumnos(boleta, nombre, firstls, secondls, email, pass, imgCadena) VALUES
    	('" . $boleta . "', '" . $name . "', '" . $firstls . "', '" . $secondls . "', '" . $email . "','" . $pass . "', '" . $imgCadena . "')";

  $verificar_boleta = mysqli_query($conn, "SELECT * FROM alumnos WHERE boleta = '$boleta' ");
  if(mysqli_num_rows($verificar_boleta) > 0){
    echo '
      <script>
        alert("Esta boleta ya ha sido registrada, intenta con otra");
        window.location = "../formulario.html";
      </script>
    ';
    exit();
  }

  if ($conn->query($sql) === TRUE) {
    echo "<h2>El estudiante se agregó correctamente</h2>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Cerrar la conexión.
  $conn->close();
}
	 
// Función para limpiar y validar datos de entrada
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
// Mostrar datos de prueba (puedes eliminar esto en producción)
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $pass_cifrada;
?>
<br>
<a  class = "neon" href="../formulario.html">Iniciar Sesion</a>
</body>
</html>