<?php
$servername = "soporteti.mysql.database.azure.com"; 
$username = "sqlsoporte"; 
$password = "Tarea123456";
$database = "soporte_ti";
// activar SSL
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, "/SSL/DigiCertGlobalRootG2.crt.pem", NULL, NULL);

mysqli_real_connect($conn, $servername, $username, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die("<h3 style='color:red;'> Error de conexión SSL con Azure MySQL: " . mysqli_connect_error() . "</h3>");
} else {
    echo "<h3 style='color:green;'> Conexión SSL a Azure MySQL exitosa</h3>";
}
?>
